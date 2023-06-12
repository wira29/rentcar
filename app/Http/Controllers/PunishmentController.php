<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Charge;
use Illuminate\Http\Request;

class PunishmentController extends Controller
{
    //
    public function index()
    {
        $data = [
            'punishment' => Rent::query()
                ->whereRelation('car', function ($q) {
                    return $q->whereRelation('rental', function ($q) {
                        return $q->where('user_id', auth()->id());
                    });
                })
                ->orderByRaw("
            CASE
            WHEN status = 'pending' THEN 1
            WHEN status = 'disewa' THEN 2
            WHEN status = 'selesai' THEN 3
            ELSE 4
            END ")
                ->get(),
        ];
        return view('dashboard.punishment.index', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Charge::create($data);

        return redirect()->back()->with('success', 'Berhasil menambahkan Denda !');
    }
}
