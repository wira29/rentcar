@extends('landing.layouts.app')

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('app-assets/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('landing.home') }}">Beranda <i class="ion-ios-arrow-forward"></i></a></span> <span>Detail <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Transaksi</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <form method="POST" id="form-rent" action="#" class="container">
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="start_date" value="{{ request()->date }}">
            <input type="hidden" name="end_date" value="{{ \Carbon\Carbon::parse(request()->date)->addDays(request()->days) }}">
            <div class="row">
                <div class="col-md-8">
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
                                            <div class="accordion" id="accordionExample">
                                                @foreach($car->rental->conditions as $condition)
                                                    <div class="">
                                                        <div class="card-header px-0" style="background-color: white" id="heading-{{$condition->id}}">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{$condition->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                    {{ $condition->title }}
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="collapse-{{$condition->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                {{ $condition->description }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
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
                            <select name="pengambilan-select" class="form-control" id="">
                                <option value="0">Kantor Rental</option>
                                <option value="1">Lokasi Lainnya</option>
                            </select>

                            <div id="pengambilan" style="display: none">
                                <h6 class="mt-3">Kecamatan</h6>
                                <select class="form-control district" name="district_pengambilan" id="">
                                    <option value="">Test</option>
                                </select>

                                <h6 class="mt-3">Kelurahan</h6>
                                <select class="form-control" name="village_pengambilan" id="">
                                    <option value="">Test</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6>Lokasi Pengembalian</h6>
                            <select name="pengembalian-select" class="form-control" id="">
                                <option value="0">Kantor Rental</option>
                                <option value="1">Lokasi Lainnya</option>
                            </select>

                            <div id="pengembalian" style="display: none">
                                <h6 class="mt-3">Kecamatan</h6>
                                <select class="form-control district" name="district_pengembalian" id="">
                                    <option value="">Test</option>
                                </select>

                                <h6 class="mt-3">Kelurahan</h6>
                                <select class="form-control" name="village_pengembalian" id="">
                                    <option value="">Test</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p>Disediakan oleh {{ $car->rental->name }}</p>
                                <p>{{ $car->rental->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <p>Total</p>
                                <h4 id="price"></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-secondary btn-block">Bayar</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('script')
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('app.midtrans_client_key') }}"></script>
    <script>
        var pricePengambilanDistrict = 0
        var pricePengembalianDistrict = 0
        var pricePengambilanVillage = 0
        var pricePengembalianVillage = 0
        var price = parseInt('{{ $car->price }}')

        function setPrice() {
            var total = price + pricePengambilanDistrict + pricePengambilanVillage + pricePengembalianDistrict + pricePengembalianVillage
            // alert(total)
            $('#price').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total))
        }

        $(document).ready(function() {


            setPrice()

            $('select[name="pengambilan-select"]').change(function() {
                if($(this).val() > 0){
                    $('#pengambilan').css('display', 'block')
                } else {
                    pricePengambilanDistrict = 0
                    pricePengambilanVillage = 0
                    $('#pengambilan').css('display', 'none')

                    setPrice()
                }
            })

            $('select[name="pengembalian-select"]').change(function() {
                if($(this).val() > 0){
                    $('#pengembalian').css('display', 'block')
                } else {
                    pricePengembalianDistrict = 0
                    pricePengembalianVillage = 0
                    $('#pengembalian').css('display', 'none')

                    setPrice()
                }
            })

            loadDistrict()
            function loadDistrict()
            {
                $.ajax({
                    method: 'GET',
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/{{ request()->regency_id }}.json`,
                    dataType: 'JSON',
                    success: function (districts) {
                        let html = ''

                        districts.map(district => {
                            if(district.id == "{{ request()->district_id }}"){
                                html += `<option selected value="${district.id}">${district.name}</option>`
                            } else {
                                html += `<option value="${district.id}">${district.name}</option>`
                            }
                        })

                        $('.district').html(html)

                        $('select[name="district_pengambilan"]').trigger("change")
                        $('select[name="district_pengembalian"]').trigger("change")
                    }
                })
            }

            $('select[name="district_pengambilan"]').change(function() {

                $.ajax({
                    method: 'GET',
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${$(this).val()}.json`,
                    dataType: 'JSON',
                    success: function (villages) {
                        let html = ''

                        villages.map(village => {
                            if(village.id == "{{ request()->village_id }}"){
                                html += `<option selected value="${village.id}">${village.name}</option>`
                            } else {
                                html += `<option value="${village.id}">${village.name}</option>`
                            }
                        })

                        $('select[name="village_pengambilan"]').html(html)
                        $('select[name="village_pengambilan"]').trigger("change")
                    }
                })

                if($(this).val() != "{{ $car->rental->district_id }}"){
                    // alert('distrik pengambilan')
                    if(pricePengambilanDistrict == 0)
                        pricePengambilanDistrict += 25000
                }else {
                    pricePengambilanDistrict = 0
                }
                setPrice()
            })

            $('select[name="district_pengembalian"]').change(function() {

                $.ajax({
                    method: 'GET',
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${$(this).val()}.json`,
                    dataType: 'JSON',
                    success: function (villages) {
                        let html = ''

                        villages.map(village => {
                            if(village.id == "{{ request()->village_id }}"){
                                html += `<option selected value="${village.id}">${village.name}</option>`
                            } else {
                                html += `<option value="${village.id}">${village.name}</option>`
                            }
                        })

                        $('select[name="village_pengembalian"]').html(html)
                        $('select[name="village_pengembalian"]').trigger("change")
                    }
                })

                if($(this).val() != "{{ $car->rental->district_id }}"){
                    // alert('distrik pengembalian')
                    if(pricePengembalianDistrict == 0)
                        pricePengembalianDistrict += 25000
                }else {
                    pricePengembalianDistrict = 0
                }
                setPrice()
            })

            $('select[name="village_pengambilan"]').change(function() {
                if($(this).val() != "{{ $car->rental->village_id }}") {
                    // alert('village pengambilan')
                    if(pricePengambilanVillage == 0)
                        pricePengambilanVillage += 10000
                } else {
                    pricePengambilanVillage = 0
                }
                // alert('aa')
                setPrice()
            })

            $('select[name="village_pengembalian"]').change(function() {
                if($(this).val() != "{{ $car->rental->village_id }}") {
                    // alert('village pengembalian')
                    if(pricePengembalianVillage == 0)
                        pricePengembalianVillage += 10000
                } else {
                    pricePengembalianVillage = 0
                }

                setPrice()
            })

            $('#form-rent').submit(function (e) {
                e.preventDefault()

                var fd = new FormData(document.getElementById('form-rent'))
                fd.append('total', price + pricePengambilanDistrict + pricePengambilanVillage + pricePengembalianDistrict + pricePengembalianVillage)

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
                        // console.log(res.url)
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
                                console.log(result, res)
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
