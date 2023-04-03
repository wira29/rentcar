<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $data = [
            'cars' => Car::where('rental_id', auth()->user()->rental->id)->paginate(8)
        ];
        return view('dashboard.car.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('cars', 'public');
        }

        $data['rental_id'] = auth()->user()->rental->id;

        Car::create($data);

        return to_route('rental.cars.index')->with('success', 'Berhasil menambahkan mobil !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Car $car
     * @return View
     */
    public function edit(Car $car): View
    {
        return view('dashboard.car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $data = $request->all();

        if($request->hasFile('photo')){
            if(Storage::exists('public/' . $car->photo)){
                Storage::delete('public/'.$car->photo);
            }

            $data['photo'] = $request->file('photo')->store('cars', 'public');
        }

        $car->update($data);

        return to_route('rental.cars.index')->with('success', 'Berhasil mengedit mobil !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        if(Storage::exists('public/' . $car->photo)){
            Storage::delete('public/'.$car->photo);
        }

        $car->delete();

        return to_route('rental.cars.index')->with('success', 'Berhasil menghapus mobil !');
    }
}
