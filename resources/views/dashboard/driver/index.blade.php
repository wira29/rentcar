@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Sopir</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Sopir</h5>
                            <h6 class="card-subtitle text-muted">List sopir yang terdaftar di {{ auth()->user()->rental->name }}.</h6>
                        </div>
                        <div class="card-body">
                            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>SIM</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($drivers as $driver)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $driver->name }}</td>
                                        <td>{{ $driver->address }}</td>
                                        <td>{{ $driver->driver_licence }}</td>
                                        <td>
                                            <a href="{{ route('rental.drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a> |
                                            <button class="btn btn-danger btn-sm delete" data-id="{{ $driver->id }}">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <x-delete-modal />
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });

            $(document).on('click', '.delete', function () {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('rental.drivers.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endsection
