<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Infra CRM ITV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
</head>
<body class="bg-slate-100">
<nav class="bg-slate-800 text-white px-4 py-3 flex gap-4 text-sm">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('machines.index') }}">Máquinas</a>
    <a href="{{ route('zones.index') }}">Zonas</a>
    <a href="{{ route('maps.index') }}">Mapa</a>
    <a href="{{ route('imports.index') }}">Importar CSV</a>
    <a href="{{ route('ranges.index') }}">Planificador IP</a>
</nav>
<main class="max-w-7xl mx-auto p-4">
    @if(session('status'))<div class="bg-emerald-100 border p-2 mb-3">{{ session('status') }}</div>@endif
    @if($errors->any())<div class="bg-rose-100 border p-2 mb-3">{{ $errors->first() }}</div>@endif
    @yield('content')
</main>
</body>
</html>
