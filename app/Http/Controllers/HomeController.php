<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Models\Payment;
use App\Models\Rent;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
     * @return View
     */
    public function index(): View
    {
        $data = [
        'rentals' => Rental::all(),
    ];

        return view('landing.pages.home.index', $data);
    }

    public function searchRentals(Request $request)
    {
        if($request->sopir > 0){
//
            $rentDriver = Rent::where(['status' => 'disewa', 'isWithDriver' => 1])->distinct()->get()->pluck('driver_id')->toArray();
            $driverRentals = Driver::query()
                ->whereIn('id', $rentDriver)
                ->get()
                ->pluck('rental_id')->toArray();

            $cars = Car::query()
                ->select('cars.id', 'rental_id', 'name', 'transmission', 'chairs_ammount', 'vehicle_license', 'merk', 'price', 'car_type', 'photo')
                ->whereRelation('rental', function ($q) use ($request) {
                    return $q->where('regency_id', $request->regency_id);
                })
                ->whereNotIn('rental_id', $driverRentals)
                ->withCount(['rents' => function($q) {
                    $q->where('status', 'disewa');
                }])
                ->having('rents_count', '<', 1)
                ->paginate(9);
        }else {
            $cars = Car::query()
                ->select('cars.id', 'rental_id', 'name', 'transmission', 'chairs_ammount', 'vehicle_license', 'merk', 'price', 'car_type', 'photo')
                ->whereRelation('rental', function ($q) use ($request) {
                    return $q->where('regency_id', $request->regency_id);
                })
                ->withCount(['rents' => function($q) use($request) {
                    $q->where('status', 'disewa');
                }])
                ->having('rents_count', '<', 1)
                ->paginate(9);
        }

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
            'custom_field1' =>  json_encode([
                'car_id' => $request->car_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'disewa',
                'users' => '2f9c3eba-24fa-3831-a84a-9016626cc89c'
            ])
        );

        $transaction = \Midtrans\Snap::createTransaction($params);

        return response()->json(['token' => $transaction->token, 'url' => $transaction->redirect_url]);
    }

    public function handleAfterPayment(Request $request)
    {
        $custom_field1 = json_decode($request->custom_field1, true);
        Rent::updateOrInsert(['id' => $request->order_id], [
            'car_id' => $custom_field1['car_id'],
            'users' => $custom_field1['users'],
            'start_date' => Carbon::parse($custom_field1['start_date'])->format('Y-m-d'),
            'end_date' => $custom_field1['end_date'],
            'status' => $custom_field1['status']
        ]);
//        dd($custom_field1);

        $data = [
            'order_id' => $request->order_id,
            'rent_id' => $request->order_id,
            'payment_type' => $request->payment_type,
            'status' => $request->transaction_status,
            'total' => $request->gross_amount,
            'date' => Carbon::now()
        ];


        $signature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('app.midtrans_server_key'));
        if($request->signature_key == $signature){
            Payment::updateOrInsert(['order_id' => $request->order_id], $data);
        }
    }
}
