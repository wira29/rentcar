@extends('landing.layouts.app')

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('app-assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Choose Your Car</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                @forelse($cars as $c)
                    <div class="col-md-4">
                        <div class="car-wrap rounded ftco-animate">
                            <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('app-assets/images/car-1.jpg') }}');">
                            </div>
                            <div class="text">
                                <h2 class="mb-0">{{ $c->name }} <span class="text-secondary">({{ $c->merk }})</span></h2>
                                <div class="d-flex mb-3">
                                    <span class="cat">{{ $c->rental->name }}</span>
                                    <p class="price ml-auto">Rp. {{number_format($c->price)}} <span>/hari</span></p>
                                </div>
                                <a href="{{ route('landing.detailRent', array_merge(request()->query(), ['car' => $c->id])) }}" type="button" class="btn btn-primary btn-lg btn-block">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <img width="250" src="{{ asset('app-assets/images/no_data.svg') }}" alt="">
                        <p>mobil tidak ditemukan.</p>
                        <a class="btn btn-secondary" href="{{ route('landing.home') }}">Kembali</a>
                    </div>
                @endforelse

            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    {{ $cars->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
