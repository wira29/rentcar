@extends('landing.layouts.app')

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('app-assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('landing.home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Transaksi <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Transaksi Anda</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="datatables-reponsive">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mobil</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal Transaksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transaction as $t)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $t->rent->car->name }}</td>
                                <td>{{ $t->rent->start_date }}</td>
                                <td>{{ $t->rent->end_date }}</td>
                                <td>{{ $t->rent->status }}</td>
                                <td>{{ $t->payment_type }}</td>
                                <td>{{ $t->status }}</td>
                                <td>Rp.{{ number_format($t->total) }}</td>
                                <td>{{ $t->date }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#datatables-reponsive').DataTable({
                ordering: false,
                searching: false,
                bLengthChange: false,
            });
        });
    </script>
@endsection
