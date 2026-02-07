<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index() { return view('imports.index'); }

    public function run(Request $request)
    {
        $request->validate(['csv' => ['required', 'file', 'mimes:csv,txt']]);
        $fh = fopen($request->file('csv')->getRealPath(), 'r');
        $header = fgetcsv($fh);
        while (($row = fgetcsv($fh)) !== false) {
            $data = array_combine($header, $row);
            if (!isset($data['IP'])) {
                continue;
            }
            Machine::updateOrCreate(
                ['ip' => $data['IP']],
                [
                    'site_id' => 1,
                    'zone_id' => 1,
                    'name' => $data['HostDNS'] ?: $data['IP'],
                    'hostname' => $data['HostDNS'] ?: null,
                    'mac' => $data['MAC'] ?: null,
                    'type' => 'otro',
                    'department' => 'pendiente',
                    'status' => 'desconocido',
                    'criticality' => 'media',
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ]
            );
        }
        fclose($fh);
        return back()->with('status', 'Importación completada.');
    }
}
