<?php

namespace App\Http\Controllers;

use App\Models\InfrastructureMap;
use App\Models\Machine;
use App\Models\MapItem;
use App\Models\Zone;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(Request $request)
    {
        $zoneId = $request->integer('zone_id') ?: Zone::query()->value('id');
        $map = InfrastructureMap::firstOrCreate(['zone_id' => $zoneId], ['site_id' => 1, 'name' => 'Mapa zona', 'width' => 1400, 'height' => 900]);
        $items = MapItem::where('map_id', $map->id)->get()->keyBy('machine_id');
        return view('maps.index', ['zones' => Zone::all(), 'zoneId' => $zoneId, 'map' => $map, 'machines' => Machine::where('zone_id', $zoneId)->get(), 'items' => $items]);
    }

    public function upload(Request $request)
    {
        $data = $request->validate(['map_id' => ['required','exists:maps,id'], 'image' => ['required','image']]);
        $path = $request->file('image')->store('maps', 'public');
        InfrastructureMap::where('id', $data['map_id'])->update(['image_path' => $path]);
        return back()->with('status', 'Plano subido.');
    }

    public function savePositions(Request $request)
    {
        $data = $request->validate(['map_id' => ['required','exists:maps,id'], 'items' => ['required','array']]);
        foreach ($data['items'] as $item) {
            MapItem::updateOrCreate(
                ['map_id' => $data['map_id'], 'machine_id' => $item['machine_id']],
                ['site_id' => 1, 'x' => $item['x'], 'y' => $item['y'], 'w' => $item['w'] ?? 140, 'h' => $item['h'] ?? 36, 'rotation' => $item['rotation'] ?? 0]
            );
        }
        return response()->json(['ok' => true]);
    }
}
