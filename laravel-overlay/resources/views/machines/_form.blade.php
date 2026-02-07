@csrf
<div class="grid md:grid-cols-3 gap-3">
    <div><label>Site</label><select name="site_id" class="w-full">@foreach($sites as $site)<option value="{{ $site->id }}" @selected(old('site_id',$machine->site_id)==$site->id)>{{ $site->name }}</option>@endforeach</select></div>
    <div><label>Zona</label><select name="zone_id" class="w-full">@foreach($zones as $zone)<option value="{{ $zone->id }}" @selected(old('zone_id',$machine->zone_id)==$zone->id)>{{ $zone->name }}</option>@endforeach</select></div>
    <div><label>Nombre</label><input class="w-full" name="name" value="{{ old('name',$machine->name) }}" required></div>
    <div><label>Hostname</label><input class="w-full" name="hostname" value="{{ old('hostname',$machine->hostname) }}"></div>
    <div><label>IP</label><input class="w-full" name="ip" value="{{ old('ip',$machine->ip) }}" required></div>
    <div><label>MAC</label><input class="w-full" name="mac" value="{{ old('mac',$machine->mac) }}"></div>
    <div><label>Tipo</label><input class="w-full" name="type" value="{{ old('type',$machine->type ?? 'pc') }}" required></div>
    <div><label>Departamento</label><input class="w-full" name="department" value="{{ old('department',$machine->department) }}" required></div>
    <div><label>Estado</label><select class="w-full" name="status">@foreach(['activo','fuera_servicio','reserva','desconocido'] as $status)<option @selected(old('status',$machine->status ?? 'desconocido')===$status)>{{ $status }}</option>@endforeach</select></div>
    <div><label>Criticidad</label><select class="w-full" name="criticality">@foreach(['baja','media','alta'] as $criticality)<option @selected(old('criticality',$machine->criticality ?? 'media')===$criticality)>{{ $criticality }}</option>@endforeach</select></div>
    <div><label>Sistema</label><input class="w-full" name="os" value="{{ old('os',$machine->os) }}"></div>
    <div><label>Vendor</label><input class="w-full" name="vendor" value="{{ old('vendor',$machine->vendor) }}"></div>
    <div><label>Modelo</label><input class="w-full" name="model" value="{{ old('model',$machine->model) }}"></div>
    <div class="md:col-span-3"><label>Razón IP bloqueada</label><input class="w-full" name="ip_locked_reason" value="{{ old('ip_locked_reason',$machine->ip_locked_reason) }}"></div>
    <div class="md:col-span-3"><label>Notas</label><textarea class="w-full" name="notes">{{ old('notes',$machine->notes) }}</textarea></div>
    <label class="inline-flex items-center gap-2"><input type="checkbox" name="cannot_move" value="1" @checked(old('cannot_move',$machine->cannot_move))> No mover</label>
</div>
<button class="mt-3 bg-slate-800 text-white px-3 py-2 rounded">Guardar</button>
