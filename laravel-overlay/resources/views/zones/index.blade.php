@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Zonas</h1>
<form method="post" action="{{ route('zones.store') }}" class="bg-white p-4 rounded mb-4">@csrf
<div class="grid md:grid-cols-4 gap-2">
<select name="site_id">@foreach($sites as $site)<option value="{{ $site->id }}">{{ $site->name }}</option>@endforeach</select>
<input name="name" placeholder="Nombre" required>
<input name="code" placeholder="Code" required>
<input name="description" placeholder="Descripción">
</div><button class="mt-2 bg-slate-800 text-white px-3 py-1 rounded">Crear zona</button></form>
<table class="w-full bg-white"><tr><th>Code</th><th>Nombre</th><th></th></tr>@foreach($zones as $zone)<tr><td>{{ $zone->code }}</td><td>{{ $zone->name }}</td><td><form method="post" action="{{ route('zones.destroy',$zone) }}">@csrf @method('delete')<button>Eliminar</button></form></td></tr>@endforeach</table>
@endsection
