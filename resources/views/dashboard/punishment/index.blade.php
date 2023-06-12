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
                            <h6 class="card-subtitle text-muted">List Denda yang terdaftar di
                                {{ auth()->user()->rental->name }}.</h6>
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
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($punishment as $hukuman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $hukuman->user->name }}</td>
                                            <td>{{ $hukuman->driver->name ?? '-' }}</td>
                                            <td>{{ $hukuman->car->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($hukuman->start_date)->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($hukuman->end_date)->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}
                                            </td>
                                            <td>{{ $hukuman->status }}</td>
                                            @if ($hukuman->status == 'disewa')
                                                <td><button class="btn btn-danger btn-sm denda"
                                                        data-id="{{ $hukuman->id }}"
                                                        onclick="modal({{ $hukuman->id }})">Denda</button></td>
                                            @else
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="dendaModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Masukkan data denda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('rental.storeDenda') }}" id="dendaForm" method="POST">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="rent_id">
                            <div class="modal-body m-3">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Tipe Kerusakan</label>
                                    <input type="text" value="{{ old('charge_type') }}" name="charge_type"
                                        class="form-control" placeholder="Goresan" autofocus />
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Total Denda</label>
                                    <input type="text" value="{{ old('total') }}" name="total" class="form-control"
                                        placeholder="Rp.100.000" autofocus />
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Deskripsi Denda</label>
                                    <textarea class="form-control" name="description" id="" cols="20" rows="5" value="{{ old('description') }}"
                                        placeholder="Deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Kirim</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
            $(document).on('click', '.denda', function() {
                $('#dendaModal').modal('show')
                const id = $(this).attr('data-id');
                $('input[name="rent_id"]').val(id)
            });
        });


        function modal(id) {
            $('#dendaModal').modal('show')
        }
    </script>
@endsection
