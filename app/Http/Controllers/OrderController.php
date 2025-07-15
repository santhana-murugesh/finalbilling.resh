<?php

namespace App\Http\Controllers;

use App\Models\BilledOrder;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'total' => 'required|numeric',
            'customer' => 'nullable|array',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Generate order number
            $latestOrder = BilledOrder::orderBy('id', 'desc')->first();
            if ($latestOrder && preg_match('/ORD(\d+)/', $latestOrder->order_number, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            } else {
                $nextNumber = 1;
            }
            $formattedOrderNumber = 'ORD' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            // Save customer if provided
            $customerId = null;
            if ($request->customer && !empty($request->customer['name'])) {
                $customer = Customer::updateOrCreate(
                    ['phone' => $request->customer['phone']],
                    [
                        'name' => $request->customer['name'],
                        'email' => $request->customer['email'] ?? null,
                        'address' => $request->customer['address'] ?? null,
                    ]
                );
                $customerId = $customer->id;
            }

            // Calculate totals
            $subtotal = collect($request->cart)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });
            
            $discount = $request->discount ?? 0;
            $tax = $request->tax ?? 0;
            $total = $request->total;

            // Create order
            $order = BilledOrder::create([
                'order_number' => $formattedOrderNumber,
                'cart' => json_encode($request->cart),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'total' => $total,
                'customer_id' => $customerId,
                'customer_info' => $request->customer ? json_encode($request->customer) : null,
                'payment_status' => 'pending',
                'order_status' => 'completed',
                'created_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Order stored successfully!',
                'order_id' => $order->id,
                'order_number' => $formattedOrderNumber,
                'customer_id' => $customerId,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Error storing order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getNextOrderNumber()
    {
        $count = BilledOrder::count();
        $nextNumber = 'ORD' . str_pad($count + 1, 6, '0', STR_PAD_LEFT);

        return response()->json(['next_order_number' => $nextNumber]);
    }

    public function orderHistory()
    {
        return view('order-history');
    }

    public function getOrderHistory()
    {
        $orders = BilledOrder::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($orders);
    }

    public function getOrderDetails($id)
    {
        $order = BilledOrder::with('customer')->findOrFail($id);
        
        return response()->json([
            'order' => $order,
            'cart_items' => json_decode($order->cart, true),
            'customer_info' => $order->customer_info ? json_decode($order->customer_info, true) : null,
        ]);
    }

    public function updateOrderStatus(Request $request, $id)
    {
        try {
            $order = BilledOrder::findOrFail($id);
            $updateData = [];

            // Handle order status update
            if ($request->has('status')) {
                $request->validate([
                    'status' => 'required|in:pending,processing,completed,cancelled',
                ]);
                $updateData['order_status'] = $request->status;
            }

            // Handle payment status update
            if ($request->has('payment_status')) {
                $request->validate([
                    'payment_status' => 'required|in:pending,received',
                ]);
                $updateData['payment_status'] = $request->payment_status;
            }

            if (!empty($updateData)) {
                $order->update($updateData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully!',
                'order' => $order
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating order status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteOrder($id)
    {
        $order = BilledOrder::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully!'
        ]);
    }

    public function getOrderStats()
    {
        $today = now()->startOfDay();
        $thisMonth = now()->startOfMonth();

        $todayOrders = BilledOrder::whereDate('created_at', $today)->get();
        $monthOrders = BilledOrder::where('created_at', '>=', $thisMonth)->get();

        $stats = [
            'today_orders' => $todayOrders->count(),
            'today_revenue' => round($todayOrders->sum('total'), 2),
            'month_orders' => $monthOrders->count(),
            'month_revenue' => round($monthOrders->sum('total'), 2),
            'total_orders' => BilledOrder::count(),
            'total_revenue' => round(BilledOrder::sum('total'), 2),
            'pending_orders' => BilledOrder::where('payment_status', 'pending')->count(),
        ];

        return response()->json($stats);
    }
}
