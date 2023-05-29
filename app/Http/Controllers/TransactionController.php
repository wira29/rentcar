<?php

namespace App\Http\Controllers;

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
}
