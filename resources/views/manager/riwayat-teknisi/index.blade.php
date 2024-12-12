@extends('layouts.app')

@section('title', 'Riwayat Teknisi')
@section('navbar')
    @include('layouts.navbar-manager')
@endsection

@section('content')
<div class="container mt-4">
    <h1>Riwayat Teknisi</h1>
    <div class="row">
        @foreach($histories as $history)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $history->technician->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $history->plane->name }}</h6>
                    <p class="card-text">Status: {{ $history->status }}</p>
                    <p class="card-text">Tanggal Pengerjaan: {{ $history->work_date }}</p>
                    <p class="card-text">{{ $history->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection