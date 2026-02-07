<?php

namespace App\Http\Controllers;

use App\Models\IpRange;
use App\Models\Machine;
use Illuminate\Http\Request;

class IpRangeController extends Controller
{
    public function index()
    {
        return view('ip-ranges.index', ['ranges' => IpRange::all(), 'machines' => Machine::paginate(30)]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'site_id' => ['required','exists:sites,id'],
            'name' => ['required'], 'start_ip' => ['required','ip'], 'end_ip' => ['required','ip'],
            'reserved_gaps' => ['nullable'], 'notes' => ['nullable'],
        ]);
        $data['reserved_gaps'] = $data['reserved_gaps'] ? json_decode($data['reserved_gaps'], true) : [];
        IpRange::create($data);
        return back()->with('status', 'Rango creado.');
    }
}
