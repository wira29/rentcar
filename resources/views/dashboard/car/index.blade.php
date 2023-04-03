@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Halaman Mobil</h1>

            <div class="row">
                @forelse($cars as $car)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('storage/'. $car->photo) }}" alt="Unsplash">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $car->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <p class="card-text col-6"><i class="fas fa-car-alt me-3"></i> {{ $car->merk }}</p>
                                    <p class="card-text col-6"><i class="fas fa-users me-3"></i> {{ $car->chairs_ammount }} penumpang</p>
                                    <p class="card-text col-6"><i class="fas fa-id-card-alt me-3"></i> {{ $car->vehicle_license }}</p>
                                    <p class="card-text col-6"><i class="fas fa-dollar me-3"></i>Rp. {{ $car->price }}</p>
                                </div>
                                <a href="{{ route('rental.cars.edit', $car->id) }}" class="card-link">Edit</a>
                                <a href="#" class="card-link delete" data-id="{{ $car->id }}">Hapus</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada mobil.</p>
                @endforelse
            </div>

            <div class="row">
                {{ $cars->links() }}
            </div>

        </div>
    </main>
    <x-delete-modal />
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            $(document).on('click', '.delete', function () {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('rental.cars.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endsection
