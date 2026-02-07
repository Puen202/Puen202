@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-3">Mapa por zona</h1>
<form class="mb-3">
<select name="zone_id" onchange="this.form.submit()">@foreach($zones as $zone)<option value="{{ $zone->id }}" @selected($zoneId===$zone->id)>{{ $zone->name }}</option>@endforeach</select>
</form>
<form method="post" action="{{ route('maps.upload') }}" enctype="multipart/form-data" class="mb-3">@csrf
<input type="hidden" name="map_id" value="{{ $map->id }}"><input type="file" name="image" required><button>Subir plano</button></form>
<div id="canvas" class="relative border bg-white overflow-hidden" style="width:100%;height:650px;background-size:cover;background-image:url('{{ $map->image_path ? asset('storage/'.$map->image_path) : '' }}')">
@foreach($machines as $machine)
@php($item = $items[$machine->id] ?? null)
<div class="node absolute bg-slate-800 text-white px-2 py-1 rounded text-xs cursor-move" data-id="{{ $machine->id }}" style="left:{{ $item->x ?? 20 }}px;top:{{ $item->y ?? 20 }}px">{{ $machine->name }} ({{ $machine->ip }})</div>
@endforeach
</div>
<button id="save" class="mt-3 bg-emerald-700 text-white px-3 py-2 rounded">Guardar posiciones</button>
<script>
const nodes=[...document.querySelectorAll('.node')];
interact('.node').draggable({listeners:{move(e){const t=e.target;const x=(parseFloat(t.dataset.x)||0)+e.dx;const y=(parseFloat(t.dataset.y)||0)+e.dy;t.style.transform=`translate(${x}px,${y}px)`;t.dataset.x=x;t.dataset.y=y;}}});
document.getElementById('save').addEventListener('click', async ()=>{
  const items=nodes.map(n=>({machine_id:+n.dataset.id,x:(parseFloat(n.style.left)||0)+(parseFloat(n.dataset.x)||0),y:(parseFloat(n.style.top)||0)+(parseFloat(n.dataset.y)||0)}));
  await fetch("{{ route('maps.positions') }}",{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({map_id:{{ $map->id }},items})});
  location.reload();
});
</script>
@endsection
