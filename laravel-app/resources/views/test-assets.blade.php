<!DOCTYPE html>
<html>
<head>
    <title>Test Assets</title>
</head>
<body>
    <h1>Test de Assets en Laravel</h1>
    
    <h2>URLs generadas por Laravel:</h2>
    <p><strong>asset('css/admin_custom.css'):</strong> {{ asset('css/admin_custom.css') }}</p>
    <p><strong>asset('vendor/livewire/livewire.js'):</strong> {{ asset('vendor/livewire/livewire.js') }}</p>
    
    <h2>URL base de la aplicación:</h2>
    <p><strong>config('app.url'):</strong> {{ config('app.url') }}</p>
    <p><strong>url('/'):</strong> {{ url('/') }}</p>
    <p><strong>request()->getSchemeAndHttpHost():</strong> {{ request()->getSchemeAndHttpHost() }}</p>
    
    <h2>Prueba de carga de CSS:</h2>
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <p style="color: red;">Si este texto aparece en rojo, el CSS se cargó correctamente.</p>
    
    <h2>Enlaces directos:</h2>
    <p><a href="{{ asset('css/admin_custom.css') }}" target="_blank">Abrir CSS</a></p>
    <p><a href="{{ asset('vendor/livewire/livewire.js') }}" target="_blank">Abrir Livewire JS</a></p>
</body>
</html>