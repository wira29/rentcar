@extends('dashboard.layout.app') @section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Rental</h1>

            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <x-errors-component />
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Rental</h5>
                        </div>
                        <div class="card-body">
                            <form
                                id="form"
                                action="{{ route('admin.rentcars.update', $rental->id) }}"
                                method="POST"
                            >
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input
                                            type="text"
                                            value="{{ $rental->name }}"
                                            name="name"
                                            class="form-control"
                                            placeholder="Bintang Cahaya Trans"
                                            autofocus
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi</label>
                                        <select
                                            class="form-control select2"
                                            data-toggle="select2"
                                            name="province_id"
                                        >
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kabupaten / Kota</label>
                                        <div class="mb-3">
                                            <select
                                                class="form-control select2"
                                                data-toggle="select2"
                                                name="regency_id"
                                            >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan</label>
                                        <select
                                            class="form-control select2"
                                            data-toggle="select2"
                                            name="district_id"
                                        >
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Desa / Kelurahan</label>
                                        <div class="mb-3">
                                            <select
                                                class="form-control select2"
                                                data-toggle="select2"
                                                name="village_id"
                                            >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="10" placeholder="alamat detail">{{ $rental->address }}</textarea>
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
                            if(province.id == "{{ $rental->province_id }}"){
                                html += `<option selected value="${province.id}">${province.name}</option>`
                            } else {
                                html += `<option value="${province.id}">${province.name}</option>`
                            }

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
                    success: function (regencies) {
                        let html = ''

                        regencies.map(regency => {
                            if(regency.id == "{{ $rental->regency_id }}"){
                                html += `<option selected value="${regency.id}">${regency.name}</option>`
                            } else {
                                html += `<option value="${regency.id}">${regency.name}</option>`
                            }
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
                    success: function (districts) {
                        let html = ''

                        districts.map(district => {
                            if(district.id == "{{ $rental->district_id }}"){
                                html += `<option selected value="${district.id}">${district.name}</option>`
                            } else {
                                html += `<option value="${district.id}">${district.name}</option>`
                            }
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
                    success: function (villages) {
                        let html = ''

                        villages.map(village => {
                            if(village.id == "{{ $rental->village_id }}"){
                                html += `<option selected value="${village.id}">${village.name}</option>`
                            } else {
                                html += `<option value="${village.id}">${village.name}</option>`
                            }
                        })

                        $('select[name="village_id"]').html(html)
                    }
                })
            })
        });
    </script>
@endsection
