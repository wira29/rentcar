<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function index(): View
    {
        $data = [
            'drivers' => Driver::all()
        ];
        return view('dashboard.driver.index', $data);
    }

    public function create(): View
    {
        return view('dashboard.driver.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['rental_id'] = auth()->user()->rental->id;

        Driver::create($data);

        return to_route('rental.drivers.index')->with('success', 'Berhasil menambahkan sopir !');
    }

    public function edit(Driver $driver)
    {
        return view('dashboard.driver.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());

        return to_route('rental.drivers.index')->with('success', 'Berhasil mengedit sopir !');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return to_route('rental.drivers.index')->with('success', 'Berhasil menghapus sopir !');
    }
}
