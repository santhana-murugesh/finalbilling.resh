@extends('Layout')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300" x-data="settingsApp()">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300">Settings</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Settings Tabs -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6 transition-colors duration-300">
            <div class="border-b border-gray-200 dark:border-gray-600 transition-colors duration-300">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button @click="activeTab = 'general'" 
                            :class="activeTab === 'general' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-300">
                        General Settings
                    </button>
                    <button @click="activeTab = 'company'" 
                            :class="activeTab === 'company' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-300">
                        Company Details
                    </button>
                    <button @click="activeTab = 'billing'" 
                            :class="activeTab === 'billing' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-300">
                        Billing Settings
                    </button>
                </nav>
            </div>

            <!-- General Settings Tab -->
            <div x-show="activeTab === 'general'" class="p-6">
                <div class="space-y-6">
                    <!-- Logo Upload Section -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 transition-colors duration-300">Company Logo</h3>
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 dark:border-gray-600 transition-colors duration-300">
                                    <img x-show="logoPreview || settings.logo" 
                                         :src="logoPreview || (settings.logo ? '/storage/' + settings.logo : '/images/default-logo.png')" 
                                         class="w-full h-full object-contain" 
                                         alt="Company Logo">
                                    <svg x-show="!logoPreview && !settings.logo" class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Upload Logo</label>
                                <input type="file" 
                                       @change="handleLogoUpload" 
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/20 file:text-blue-700 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/30 transition-colors duration-300">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 transition-colors duration-300">PNG, JPG, GIF up to 2MB</p>
                                <button x-show="settings.logo" 
                                        @click="deleteLogo" 
                                        class="mt-2 text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-300">
                                    Remove current logo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 transition-colors duration-300">Company Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Company Name</label>
                                <input type="text" 
                                       x-model="form.company_name" 
                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                       placeholder="Enter company name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Phone Number</label>
                                <input type="tel" 
                                       x-model="form.company_phone" 
                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                       placeholder="Enter phone number">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Email Address</label>
                                <input type="email" 
                                       x-model="form.company_email" 
                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                       placeholder="Enter email address">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Website</label>
                                <input type="url" 
                                       x-model="form.company_website" 
                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                       placeholder="Enter website URL">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Company Address</label>
                                <textarea x-model="form.company_address" 
                                          rows="3" 
                                          class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                          placeholder="Enter company address"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">GST Number</label>
                                <input type="text" 
                                       x-model="form.gst_number" 
                                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                       placeholder="Enter GST number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Details Tab -->
            <div x-show="activeTab === 'company'" class="p-6">
                <div class="space-y-6">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4 transition-colors duration-300">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200 transition-colors duration-300">Company Details</h3>
                                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300 transition-colors duration-300">
                                    <p>This information will be displayed on all your bills and invoices. Make sure all details are accurate and up-to-date.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Company Name</label>
                            <input type="text" 
                                   x-model="form.company_name" 
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="Enter company name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Phone Number</label>
                            <input type="tel" 
                                   x-model="form.company_phone" 
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="Enter phone number">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Email Address</label>
                            <input type="email" 
                                   x-model="form.company_email" 
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="Enter email address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Website</label>
                            <input type="url" 
                                   x-model="form.company_website" 
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="Enter website URL">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Company Address</label>
                            <textarea x-model="form.company_address" 
                                      rows="3" 
                                      class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                      placeholder="Enter company address"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">GST Number</label>
                            <input type="text" 
                                   x-model="form.gst_number" 
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="Enter GST number">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing Settings Tab -->
            <div x-show="activeTab === 'billing'" class="p-6">
                <div class="space-y-6">
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4 transition-colors duration-300">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800 dark:text-green-200 transition-colors duration-300">Billing Configuration</h3>
                                <div class="mt-2 text-sm text-green-700 dark:text-green-300 transition-colors duration-300">
                                    <p>Configure your billing preferences, tax rates, and invoice settings.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Tax Rate (%)</label>
                            <input type="number" 
                                   x-model="form.tax_rate" 
                                   min="0" 
                                   max="100" 
                                   step="0.01"
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="18.00">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Currency Symbol</label>
                            <input type="text" 
                                   x-model="form.currency_symbol" 
                                   maxlength="10"
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="₹">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">Invoice Prefix</label>
                            <input type="text" 
                                   x-model="form.invoice_prefix" 
                                   maxlength="10"
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300"
                                   placeholder="ORD">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 transition-colors duration-300">
                <div class="flex justify-end space-x-3">
                    <button @click="resetForm" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                        Reset
                    </button>
                    <button @click="saveSettings" 
                            :disabled="saving"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-300">
                        <span x-show="!saving">Save Settings</span>
                        <span x-show="saving" class="flex items-center space-x-2">
                            <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Saving...</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Preview Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 transition-colors duration-300">Bill Preview</h3>
            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-6 bg-gray-50 dark:bg-gray-700 transition-colors duration-300">
                <div class="text-center mb-4">
                    <div class="text-xl font-bold text-gray-900 dark:text-white transition-colors duration-300" x-text="form.company_name || 'Company Name'"></div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300" x-text="form.company_address || 'Company Address'"></div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300" x-text="form.company_phone || 'Phone Number'"></div>
                </div>
                <div class="text-center text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300">
                    <span x-text="form.invoice_prefix || 'ORD'"></span>000001 | Date: {{ now()->format('d-m-Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div x-show="showToast" 
         x-transition 
         class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span x-text="toastMessage"></span>
    </div>

    <!-- Error Toast -->
    <div x-show="showError" 
         x-transition 
         class="fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        <span x-text="errorMessage"></span>
    </div>
</div>

<script>
    function settingsApp() {
        return {
            activeTab: 'general',
            saving: false,
            showToast: false,
            showError: false,
            toastMessage: '',
            errorMessage: '',
            logoPreview: null,
            settings: @json($settings ?? null),
            form: {
                company_name: @json($settings->company_name ?? ''),
                company_address: @json($settings->company_address ?? ''),
                company_phone: @json($settings->company_phone ?? ''),
                company_email: @json($settings->company_email ?? ''),
                company_website: @json($settings->company_website ?? ''),
                gst_number: @json($settings->gst_number ?? ''),
                tax_rate: @json($settings->tax_rate ?? 18),
                currency_symbol: @json($settings->currency_symbol ?? '₹'),
                invoice_prefix: @json($settings->invoice_prefix ?? 'ORD'),
            },
            
            init() {
                this.loadSettings();
            },
            
            loadSettings() {
                fetch('/api/settings')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.settings) {
                            this.settings = data.settings;
                            this.form = {
                                company_name: data.settings.company_name || '',
                                company_address: data.settings.company_address || '',
                                company_phone: data.settings.company_phone || '',
                                company_email: data.settings.company_email || '',
                                company_website: data.settings.company_website || '',
                                gst_number: data.settings.gst_number || '',
                                tax_rate: data.settings.tax_rate || 18,
                                currency_symbol: data.settings.currency_symbol || '₹',
                                invoice_prefix: data.settings.invoice_prefix || 'ORD',
                            };
                        }
                    });
            },
            
            handleLogoUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        this.showErrorMessage('Logo file size must be less than 2MB');
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.logoPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            
            deleteLogo() {
                if (confirm('Are you sure you want to delete the current logo?')) {
                    fetch('/api/settings/delete-logo', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.settings.logo = null;
                            this.logoPreview = null;
                            this.showToastMessage('Logo deleted successfully!');
                        } else {
                            this.showErrorMessage(data.message);
                        }
                    });
                }
            },
            
            saveSettings() {
                this.saving = true;
                
                console.log('Saving settings with data:', this.form);
                
                const formData = new FormData();
                formData.append('company_name', this.form.company_name);
                formData.append('company_address', this.form.company_address);
                formData.append('company_phone', this.form.company_phone);
                formData.append('company_email', this.form.company_email);
                formData.append('company_website', this.form.company_website);
                formData.append('gst_number', this.form.gst_number);
                formData.append('tax_rate', this.form.tax_rate);
                formData.append('currency_symbol', this.form.currency_symbol);
                formData.append('invoice_prefix', this.form.invoice_prefix);
                
                // Add logo file if selected
                const logoFile = document.querySelector('input[type="file"]').files[0];
                if (logoFile) {
                    formData.append('logo', logoFile);
                }
                
                fetch('/api/settings/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    this.saving = false;
                    if (data.success) {
                        this.settings = data.settings;
                        this.logoPreview = null;
                        this.showToastMessage('Settings updated successfully!');
                    } else {
                        let errorMessage = data.message || 'Settings update failed';
                        if (data.errors) {
                            // Show detailed validation errors
                            const errorDetails = Object.values(data.errors).flat().join(', ');
                            errorMessage = 'Validation failed: ' + errorDetails;
                        }
                        this.showErrorMessage(errorMessage);
                    }
                })
                .catch(error => {
                    console.error('Settings save error:', error);
                    this.saving = false;
                    this.showErrorMessage('Error saving settings: ' + error.message);
                });
            },
            
            resetForm() {
                this.loadSettings();
                this.logoPreview = null;
                document.querySelector('input[type="file"]').value = '';
            },
            
            showToastMessage(message) {
                this.toastMessage = message;
                this.showToast = true;
                setTimeout(() => this.showToast = false, 3000);
            },
            
            showErrorMessage(message) {
                this.errorMessage = message;
                this.showError = true;
                setTimeout(() => this.showError = false, 3000);
            }
        }
    }
</script>

@endsection 