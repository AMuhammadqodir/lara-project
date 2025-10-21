@extends('layouts.app')

@section('title', 'Ректор Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Факультетлар сони</p>
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>1200</h3>
                <p>Студентлар сони</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Салом, {{ $user['nom'] }} {{ $user['nasab'] }}</h3>
    </div>
    <div class="card-body">
        Сиз ректор сифатида университетнинг барча маълумотларига кириш имконига эгасиз.
    </div>
</div>
@endsection
