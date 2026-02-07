<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Zone;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $total = Machine::count();
        $byStatus = Machine::selectRaw('status, count(*) total')->groupBy('status')->pluck('total', 'status');
        $byZone = Zone::withCount('machines')->get();
        $duplicateIps = Machine::selectRaw('ip, count(*) c')->groupBy('ip')->having('c', '>', 1)->count();

        return view('dashboard.index', compact('total', 'byStatus', 'byZone', 'duplicateIps'));
    }
}
