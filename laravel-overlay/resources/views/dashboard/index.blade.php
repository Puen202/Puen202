@extends('layouts.app')
@section('content')
<div class="grid md:grid-cols-4 gap-3 mb-4">
    <div class="bg-white p-3 rounded">Total equipos: <b>{{ $total }}</b></div>
    <div class="bg-white p-3 rounded">IPs duplicadas: <b>{{ $duplicateIps }}</b></div>
    <div class="bg-white p-3 rounded">Activos: <b>{{ $byStatus['activo'] ?? 0 }}</b></div>
    <div class="bg-white p-3 rounded">Reserva: <b>{{ $byStatus['reserva'] ?? 0 }}</b></div>
</div>
<div class="bg-white rounded p-4">
    <h2 class="font-semibold mb-2">Equipos por zona</h2>
    @foreach($byZone as $zone)
        <div>{{ $zone->name }}: {{ $zone->machines_count }}</div>
    @endforeach
</div>
@endsection
