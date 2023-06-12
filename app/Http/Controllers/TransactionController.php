<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = [
            'transaction' => Payment::query()
                            ->whereRelation('rent', function($q) {
                                return $q->where('users', auth()->id());
                            })
                            ->orderBy('date', 'desc')
                            ->get()
        ];

        return view('landing.pages.transaction.index', $data);
    }

    public function setSelesai(Rent $rent)
    {
        $rent->update(['status' => 'selesai']);

        return back();
    }

    public function transaksiRental()
    {
        $data = [
            'transaction' => Rent::query()
            ->whereRelation('car', function($q) {
                return $q->whereRelation('rental', function($q){
                    return $q->where('user_id', auth()->id());
                });
            })
            ->get()
        ];
//        dd($data);
        return view('dashboard.transaction.index', $data);
    }
}
