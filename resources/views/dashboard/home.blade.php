@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Selamat Datang, {{ auth()->user()->name }}</h1>

            <div class="row">
                <div class="col-4">
                    <div class="card card-body">
                        <h1>{{ count($users) }}</h1>
                        <p>Pengguna</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-body">
                        <h1>{{ count($rentals) }}</h1>
                        <p>Rental</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-body">
                        <h1>{{ count($transactions) }}</h1>
                        <p>Transaksi</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
