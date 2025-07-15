<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><span x-text="settings ? settings.company_name : 'Reshma Crackers'"></span> Billing</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script>
    function currentRoute(route) {
        return route === "{{ Route::currentRouteName() }}";
    }
</script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    @yield('content')
</body>
</html>