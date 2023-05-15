<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RentcarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $data = [
            'rentals' => Rental::all(),
        ];

        return view('dashboard.rentcar.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rentcar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $email = explode(' ', $request->name)[0];
        $user = User::create([
            'name'  => $request->name,
            'email' => strtolower($email) . '@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('rental');

        $data = $request->all();
        $data['user_id'] = $user->id;

        Rental::create($data);

        return to_route('admin.rentcars.index')->with('success', 'Berhasil menambahkan rental !');
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
     * @param Rental $rentcar
     * @return View
     */
    public function edit(Rental $rentcar): View
    {
        $data = [
            'rental' => $rentcar
        ];

        return view('dashboard.rentcar.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rental $rentcar
     * @return RedirectResponse
     */
    public function update(Request $request, Rental $rentcar): RedirectResponse
    {
        $rentcar->update($request->all());

        return to_route('admin.rentcars.index')->with('success', 'Berhasil mengedit rental !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rental $rentcar
     * @return RedirectResponse
     */
    public function destroy(Rental $rentcar): RedirectResponse
    {
        User::where('id', $rentcar->user_id)->delete();

        return back()->with('success', 'Berhasil menghapus rental !');
    }
}
