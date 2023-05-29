<?php

namespace App\Http\Controllers\Dashboard;

use Hash;
use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use File;
use Carbon\Carbon;


class ProfileRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $data['user'] = $user;

        return view('dashboard.editProfile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $user = User::find($id);
        
        $user->email = $request->email;
        $user->name = trim($request->first_name).' '.trim($request->last_name);
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        if(isset($request->password) && $request->password != '')
        {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // dd($request->file('photo'));

        if ($request->file('photo')) {

            //delete old photo if exist
            if(File::exists($user->photo))
            {
                File::delete($user->photo);
            }

            //get file
            $file = $request->file('photo');
            $folderPath = 'uploads/user/' . $user->id . '/';
            $name = 'user-photo-'.Carbon::now()->timestamp. '.' .$file->getClientOriginalExtension();

            $user->photo = $folderPath . $name; // upload path
            $user->save();

            // create the directory if its not there, this is a must since intervention did not create the directory automatically
            File::exists($folderPath) or File::makeDirectory($folderPath, 0755, true);
            //save file
            $request->file('photo')->move($folderPath, $name);

        }

        return redirect()->back()->with('success', 'Berhasil mengedit profile !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
