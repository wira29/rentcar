@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Denda</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Denda</h5>
                            <h6 class="card-subtitle text-muted">List denda yang terdaftar di {{ auth()->user()->rental->name }}.</h6>
                        </div>
                        <div class="card-body">
                            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tipe Kerusakan</th>
                                    <th>Total Denda</th>
                                    <th>Deskripsi Denda</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penalty as $hukuman)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$hukuman->charge_type}}</td>
                                        <td>Rp. {{ number_format($hukuman->total, 0, ',', '.') }}</td>
                                        <td>{{$hukuman->description}}</td>
                                        <td><button class="btn btn-danger btn-sm delete" data-id="{{ $hukuman->id }}">Hapus</button></td>
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
                let url = `{{ route('rental.denda.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endsection
