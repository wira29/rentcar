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
                <form method="POST" id="form-rent" action="#" class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="{{  asset('app-assets/images/car-1.jpg') }}" width="250" height="150" alt="">
                                </div>
                                <div class="col-md-7">
                                    <h4>{{ $car->name }}</h4>
                                    <p>Disediakan oleh {{ $car->rental->name }}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Kebijakan Rental</h6>
                                            <p>{{ $car->rental->policies }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Syarat Rental</h6>
                                            <p>{{ $car->rental->policies }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Informasi Penting</h6>
                                            <p>Sebelum Anda pesan</p>
                                            <ul>
                                                <li>Pastikan untuk membaca syarat rental.</li>
                                            </ul>
                                            <p>Setelah Anda pesan</p>
                                            <ul>
                                                <li>Penyedia akan menghubungi pengemudi melalui WhatsApp untuk meminta foto beberapa dokumen wajib.</li>
                                            </ul>
                                            <p>Saat pengambilan</p>
                                            <ul>
                                                <li>Bawa KTP, SIM A, dan dokumen-dokumen lain yang dibutuhkan oleh penyedia rental.</li>
                                                <li>Saat Anda bertemu dengan staf rental, cek kondisi mobil dengan staf.</li>
                                                <li>Setelah itu, baca dan tanda tangan perjanjian rental.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6>Lokasi Pengambilan</h6>
                            <select name="" class="form-control" id="">
                                <option value="">Kantor Rental</option>
                                <option value="">Lokasi Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6>Lokasi Pengembalian</h6>
                            <select name="" class="form-control" id="">
                                <option value="">Kantor Rental</option>
                                <option value="">Lokasi Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary mt-3">Bayar</button>
                    </div>
                </form>
                <div class="col-md-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p>Disediakan oleh {{ $car->rental->name }}</p>
                                <p>{{ $car->rental->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('app.midtrans_client_key') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form-rent').submit(function (e) {
                e.preventDefault()

                var fd = new FormData(document.getElementById('form-rent'))

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: '{{ route('landing.bayar') }}',
                    data: fd,
                    enctype: 'multipart/form-data',
                    dataType: 'JSON',
                    success : function (res) {
                        console.log(res)
                        window.snap.pay(res.token, {
                            onSuccess: function(result){
                                /* You may add your own implementation here */
                                Swal.fire(
                                    'Berhasil',
                                    'Terimakasih atas kebaikan anda !',
                                    'success'
                                )
                            },
                            onPending: function(result){
                                /* You may add your own implementation here */
                                // alert("wating your payment!"); console.log(result);
                                Swal.fire(
                                    'Menunggu',
                                    'Silahkan melakukan pembayaran !',
                                    'info'
                                )
                            },
                            onError: function(result){
                                /* You may add your own implementation here */
                                // alert("payment failed!"); console.log(result);
                                Swal.fire(
                                    'Error',
                                    'Maaf, terjadi kesalahan !',
                                    'error'
                                )
                            },
                            onClose: function(){
                                /* You may add your own implementation here */
                                // alert('you closed the popup without finishing the payment');
                            }
                        });

                        $('input[name="jumlah"]').val("")
                        $('textarea[name="pesan"]').val("")
                    }
                })
            })
        })
    </script>
@endsection
