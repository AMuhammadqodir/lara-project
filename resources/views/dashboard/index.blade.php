@extends('dashboard.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Асосий маълумотлар</h3>
    </div>
    <div class="card-body">
        <p>Салом, {{ $user['nom'] }} {{ $user['nasab'] }}!</p>
        <p>Сиз {{ $user['maqom_id'] }} мақомга эгасиз.</p>
    </div>
</div>
@endsection
