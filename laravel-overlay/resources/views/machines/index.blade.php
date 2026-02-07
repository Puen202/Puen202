@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-3"><h1 class="text-xl font-semibold">Máquinas</h1><div class="space-x-2"><a class="bg-slate-800 text-white px-3 py-2 rounded" href="{{ route('machines.create') }}">Nuevo</a><a class="bg-emerald-700 text-white px-3 py-2 rounded" href="{{ route('machines.export') }}">Export CSV</a></div></div>
<table class="w-full bg-white rounded text-sm"><thead><tr class="text-left border-b"><th>Nombre</th><th>IP</th><th>Tipo</th><th>Dep.</th><th>Estado</th><th>No mover</th><th></th></tr></thead><tbody>
@foreach($machines as $machine)
<tr class="border-b"><td>{{ $machine->name }}</td><td>{{ $machine->ip }}</td><td>{{ $machine->type }}</td><td>{{ $machine->department }}</td><td>{{ $machine->status }}</td><td>{{ $machine->cannot_move ? 'Sí' : 'No' }}</td><td class="space-x-2"><a href="{{ route('machines.edit',$machine) }}">Editar</a><form class="inline" method="post" action="{{ route('machines.destroy',$machine) }}">@csrf @method('delete')<button>Eliminar</button></form></td></tr>
@endforeach
</tbody></table>
<div class="mt-3">{{ $machines->links() }}</div>
@endsection
