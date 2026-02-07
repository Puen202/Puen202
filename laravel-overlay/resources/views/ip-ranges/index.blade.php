@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Planificador IP</h1>
<form method="post" action="{{ route('ranges.store') }}" class="bg-white p-3 rounded mb-3">@csrf
<div class="grid md:grid-cols-5 gap-2"><input name="site_id" value="1"><input name="name" placeholder="Nombre"><input name="start_ip" placeholder="Inicio"><input name="end_ip" placeholder="Fin"><input name="reserved_gaps" placeholder='[[1,5],[200,210]]'></div>
<button class="mt-2 bg-slate-800 text-white px-3 py-1 rounded">Crear rango</button></form>
<div class="bg-white p-3 rounded mb-3"><h2 class="font-semibold">Rangos</h2>@foreach($ranges as $range)<div>{{ $range->name }}: {{ $range->start_ip }} - {{ $range->end_ip }} | huecos: {{ json_encode($range->reserved_gaps) }}</div>@endforeach</div>
<div class="bg-white p-3 rounded"><h2 class="font-semibold">Equipos / IP actual</h2>@foreach($machines as $machine)<div>{{ $machine->name }} - {{ $machine->ip }} @if($machine->cannot_move)<span class="text-red-700">(NO mover)</span>@endif</div>@endforeach</div>
@endsection
