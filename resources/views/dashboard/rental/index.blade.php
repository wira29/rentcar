@extends('dashboard.layout.app')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Profile Rental</h1>

            <div class="row">
                <div class="col-md-4 col-xl-4">

                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ ($profile->photo) ? asset('storage/' . $profile->photo) : asset('admin-assets/img/avatars/avatar.png') }}" alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="150" height="150">
                            <h5 class="card-title mb-0">{{ $profile->name }}</h5>
                            <div class="text-muted mb-2">{{ $profile->email }}</div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <h5 class="h6 card-title">Detail</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-sm me-1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> {{ $profile->address }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-8">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account" role="tabpanel">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>Sukses!</strong> {{ session('success')  }}
                                    </div>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('rental.rental.update', $profile->id) }}"
                                          enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nama</label>
                                                <input type="text" value="{{ $profile->name }}" name="name" class="form-control" placeholder="Nama">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label w-100">Logo</label>
                                                <input class="form-control" type="file" name="photo">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Alamat</label>
                                                <textarea class="form-control" placeholder="Textarea" name="address" rows="3">{{ $profile->address }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Kebijakan</label>
                                                <textarea class="form-control" placeholder="kebijakan rental" name="policies" rows="3">{{ $profile->policies }}</textarea>
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

                                        <button type="submit" class="btn btn-primary">Perbarui profil</button>
                                    </form>

                                </div>
                            </div>

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
                            if(province.id == "{{ $profile->province_id }}"){
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
                            if(regency.id == "{{ $profile->regency_id }}"){
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
                            if(district.id == "{{ $profile->district_id }}"){
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
                            if(village.id == "{{ $profile->village_id }}"){
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
