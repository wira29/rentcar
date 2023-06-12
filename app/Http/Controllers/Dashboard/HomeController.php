<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $data = [
            'rentals' => Rental::all(),
            'users' => User::whereHas("roles", function($q){ $q->where("name", "customer"); })->get(),
            'transactions' => Rent::all()
        ];
        return view('dashboard.home', $data);
    }
}
