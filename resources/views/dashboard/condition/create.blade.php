@extends('dashboard.layout.app') @section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Kondisi</h1>

            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <x-errors-component />
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tambah Kondisi</h5>
                        </div>
                        <div class="card-body">
                            <form
                                id="form"
                                action="{{ route('rental.conditions.store') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @method('POST') @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Judul</label>
                                        <input
                                            type="text"
                                            value="{{ old('title') }}"
                                            name="title"
                                            class="form-control"
                                            placeholder="KTP/paspor"
                                            autofocus
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea type="number" rows="4" cols="4" class="form-control" name="description" value="{{ old('description') }}" placeholder="Pengemudi harus membagikan kepada penyedia foto KTP/paspor mereka."></textarea>
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
