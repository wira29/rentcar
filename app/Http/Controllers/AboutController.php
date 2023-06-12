<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $data = [
            'rentals' => Rental::all(),
            'users' => User::whereHas("roles", function($q){ $q->where("name", "customer"); })->get(),
            'transactions' => Rent::all(),
            'cars' => Car::all()
        ];
        return \view('landing.pages.about.index', $data);
    }
}
