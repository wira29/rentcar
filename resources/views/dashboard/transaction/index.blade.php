@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Transaksi</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Transaksi</h5>
                            <h6 class="card-subtitle text-muted">List Transaksi yang terdaftar di {{ auth()->user()->rental->name }}.</h6>
                        </div>
                        <div class="card-body">
                            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyewa</th>
                                    <th>Nama Sopir</th>
                                    <th>Nama Mobil</th>
                                    <th>Mulai Tanggal</th>
                                    <th>Selesai Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction as $transaksi)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$transaksi->user->name}}</td>
                                        <td>{{($transaksi->driver) ? $transaksi->driver->name : '-'}}</td>
                                        <td>{{$transaksi->car->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->start_date)->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->end_date)->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}</td>
                                        <td>{{$transaksi->status}}</td>
                                        <td>
                                            @if($transaksi->status != 'selesai')
                                                <button data-id="{{ $transaksi->id }}" class="btn btn-success btn-selesai">Konfirmasi Selesai</button>
                                            @else
                                                -
                                            @endif
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

        $('.btn-selesai').click(function() {
            const konf = window.confirm("apakah anda yakin ?")

            if(konf){
                window.location.replace('{{ route("rental.setSewaSelesai", ":id") }}'.replace(":id", $(this).data("id")))
            }
        })
    </script>
@endsection
