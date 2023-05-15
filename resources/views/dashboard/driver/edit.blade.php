@extends('dashboard.layout.app') @section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Halaman Sopir</h1>

            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <x-errors-component />
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Sopir</h5>
                        </div>
                        <div class="card-body">
                            <form
                                id="form"
                                action="{{ route('rental.drivers.update', $driver->id) }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @method('PATCH') @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input
                                            type="text"
                                            value="{{ $driver->name }}"
                                            name="name"
                                            class="form-control"
                                            placeholder="Budi Sudarsono"
                                            autofocus
                                        />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">SIM</label>
                                        <input
                                            type="text"
                                            value="{{ $driver->driver_licence }}"
                                            name="driver_licence"
                                            class="form-control"
                                            placeholder="1221-xxxx-xxxxxx"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Alamat</label>
                                        <textarea type="number" rows="4" cols="4" class="form-control" name="address" value="{{ $driver->address }}" placeholder="Jl Pemuda No 28 A, Malang">{{ $driver->address }}</textarea>
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


        });
    </script>
@endsection
