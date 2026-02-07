<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Site;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function index() { return view('zones.index', ['zones' => Zone::latest()->paginate(20), 'sites' => Site::all()]); }
    public function store(StoreZoneRequest $request) { Zone::create($request->validated()); return back()->with('status', 'Zona creada.'); }
    public function update(UpdateZoneRequest $request, Zone $zone) { $zone->update($request->validated()); return back()->with('status', 'Zona actualizada.'); }
    public function destroy(Zone $zone) { $zone->delete(); return back()->with('status', 'Zona eliminada.'); }
}
