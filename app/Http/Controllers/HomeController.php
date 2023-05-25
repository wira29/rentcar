<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application landing.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landing.pages.home.index');
    }

    public function searchRentals(Request $request)
    {
//        dd($request->regency_id);
        $cars = Car::query()
            ->select('cars.id', 'rental_id', 'name', 'transmission', 'chairs_ammount', 'vehicle_license', 'merk', 'price', 'car_type', 'photo')
            ->whereRelation('rental', function ($q) use ($request) {
                return $q->where('regency_id', $request->regency_id);
            })
            ->withCount(['rents' => function($q) use($request) {
                $q->where('end_date', '>=', $request->date);
            }])
            ->having('rents_count', '<', 1)
            ->paginate(9);

        return view('landing.pages.home.search', compact('cars', 'request'));
    }

    public function detailRent(Car $car)
    {
        return view('landing.pages.home.detail', compact('car'));
    }

    public function bayar(Request $request): JsonResponse
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('app.midtrans_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->total,
            ),
            'customer_details' => array(
                'first_name' => 'test user',
                'email' => 'testemail@gmail.com'
            ),
            'custom_field1' => [
                'car_id' => $request->car_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'disewa',
                'users' => '2f9c3eba-24fa-3831-a84a-9016626cc89c'
            ]
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }

    public function handleAfterPayment(Request $request)
    {

        $data = [
            'order_id' => $request->order_id,
            'payment_type' => $request->payment_type,
            'status' => $request->transaction_status,
            'amount' => $request->gross_amount,
            'date' => Carbon::now(),
            'user_id' => $request->custom_field2,
        ];


        $signature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('app.midtrans_server_key'));
        if($request->signature_key == $signature){
            Donation::updateOrInsert(['order_id' => $request->order_id], $data);
        }
    }
}
