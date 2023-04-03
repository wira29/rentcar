@extends('dashboard.layout.app') @section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Mobil</h1>

            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <x-errors-component />
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tambah Mobil</h5>
                        </div>
                        <div class="card-body">
                            <form
                                id="form"
                                action="{{ route('rental.cars.store') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @method('POST') @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Mobil</label>
                                        <input
                                            type="text"
                                            value="{{ old('name') }}"
                                            name="name"
                                            class="form-control"
                                            placeholder="Avanza Veloz"
                                            autofocus
                                        />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Transmisi</label>
                                        <select class="form-control" name="transmission">
                                            <option value="manual">Manual</option>
                                            <option value="automatic">Automatic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Jumlah Kursi</label>
                                        <input type="number" min="2" class="form-control" name="chairs_ammount" value="{{ old('chairs_ammount') }}" placeholder="6">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">No Polisi</label>
                                        <input type="text" class="form-control" name="vehicle_license" value="{{ old('vehicle_license') }}" placeholder="N 1543 RE">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Merk</label>
                                        <input type="text" class="form-control" name="merk" value="{{ old('merk') }}" placeholder="Honda">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Harga / hari</label>
                                        <input type="number" min="0" class="form-control" name="price" value="{{ old('price') }}" placeholder="250000">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <label class="form-label">Jenis Kendaraan</label>
                                        <select class="form-control" name="car_type">
                                            <option value="city car">City Car</option>
                                            <option value="compact mpv">Compact MPV</option>
                                            <option value="mini mpv">Mini MPV</option>
                                            <option value="minivan">Minivan</option>
                                            <option value="suv">SUV</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Photo</label>
                                        <input type="file" class="form-control" name="photo" placeholder="gambar mobil">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select2
            $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })

            loadProvince()

            function loadProvince()
            {
                $.ajax({
                    method: 'GET',
                    url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                    dataType: 'JSON',
                    success: function (provinces) {
                        let html = ''

                        provinces.map(province => {
                            html += `<option value="${province.id}">${province.name}</option>`
                        })

                        $('select[name="province_id"]').html(html)

                        $('select[name="province_id"]').trigger("change")
                    }
                })
            }

            $('select[name="province_id"]').change(function() {
                $.ajax({
                    method: 'GET',
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${$(this).val()}.json`,
                    dataType: 'JSON',
                    success: function (provinces) {
                        let html = ''

                        provinces.map(province => {
                            html += `<option value="${province.id}">${province.name}</option>`
                        })

                        $('select[name="regency_id"]').html(html)

                        $('select[name="regency_id"]').trigger("change")
                    }
                })
            })

            $('select[name="regency_id"]').change(function() {
                $.ajax({
                    method: 'GET',
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${$(this).val()}.json`,
                    dataType: 'JSON',
                    success: function (provinces) {
                        let html = ''

                        provinces.map(province => {
                            html += `<option value="${province.id}">${province.name}</option>`
                        })

                        $('select[name="district_id"]').html(html)

                        $('select[name="district_id"]').trigger("change")
                    }
                })
            })

            $('select[name="district_id"]').change(function() {
                $.ajax({
                    method: 'GET',
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${$(this).val()}.json`,
                    dataType: 'JSON',
                    success: function (provinces) {
                        let html = ''

                        provinces.map(province => {
                            html += `<option value="${province.id}">${province.name}</option>`
                        })

                        $('select[name="village_id"]').html(html)
                    }
                })
            })
        });
    </script>
@endsection
