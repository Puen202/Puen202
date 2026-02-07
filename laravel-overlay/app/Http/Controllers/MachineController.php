<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Models\Machine;
use App\Models\Site;
use App\Models\Zone;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MachineController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');
        $machines = Machine::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($nested) use ($q) {
                    $nested->where('name', 'like', "%{$q}%")
                        ->orWhere('hostname', 'like', "%{$q}%")
                        ->orWhere('ip', 'like', "%{$q}%")
                        ->orWhere('mac', 'like', "%{$q}%");
                });
            })
            ->when($request->department, fn ($query) => $query->where('department', $request->department))
            ->when($request->type, fn ($query) => $query->where('type', $request->type))
            ->when($request->status, fn ($query) => $query->where('status', $request->status))
            ->when($request->criticality, fn ($query) => $query->where('criticality', $request->criticality))
            ->latest()->paginate(20)->withQueryString();

        return view('machines.index', ['machines' => $machines, 'zones' => Zone::all(), 'sites' => Site::all()]);
    }

    public function create()
    {
        return view('machines.create', ['machine' => new Machine(), 'zones' => Zone::all(), 'sites' => Site::all()]);
    }

    public function store(StoreMachineRequest $request)
    {
        $payload = $request->validated();
        $payload['created_by'] = $request->user()->id;
        $payload['updated_by'] = $request->user()->id;
        Machine::create($payload);
        return redirect()->route('machines.index')->with('status', 'Equipo creado.');
    }

    public function edit(Machine $machine)
    {
        return view('machines.edit', ['machine' => $machine, 'zones' => Zone::all(), 'sites' => Site::all()]);
    }

    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        if ($machine->cannot_move && $machine->ip !== $request->ip && !$request->user()->hasRole('admin')) {
            return back()->withErrors(['ip' => 'Este equipo está marcado como NO mover.']);
        }

        $payload = $request->validated();
        $payload['updated_by'] = $request->user()->id;
        $machine->update($payload);
        return redirect()->route('machines.index')->with('status', 'Equipo actualizado.');
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();
        return back()->with('status', 'Equipo eliminado.');
    }

    public function export(Request $request): StreamedResponse
    {
        $rows = Machine::query()->get();
        return response()->streamDownload(function () use ($rows) {
            $fh = fopen('php://output', 'w');
            fputcsv($fh, ['name','hostname','ip','mac','type','department','zone_id','status','criticality']);
            foreach ($rows as $row) {
                fputcsv($fh, [$row->name,$row->hostname,$row->ip,$row->mac,$row->type,$row->department,$row->zone_id,$row->status,$row->criticality]);
            }
            fclose($fh);
        }, 'machines.csv');
    }
}
