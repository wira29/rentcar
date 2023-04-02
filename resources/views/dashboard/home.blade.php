@extends('dashboard.layout.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Selamat Datang, {{ auth()->user()->name }}</h1>

        </div>
    </main>
@endsection
