@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Importar CSV (IP,HostDNS,MAC)</h1>
<form method="post" action="{{ route('imports.run') }}" enctype="multipart/form-data" class="bg-white p-4 rounded">@csrf
<input type="file" name="csv" required>
<button class="bg-slate-800 text-white px-3 py-2 rounded">Importar</button>
</form>
@endsection
