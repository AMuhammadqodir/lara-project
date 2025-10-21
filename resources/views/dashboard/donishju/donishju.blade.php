@extends('layouts.app')

@section('title', 'Донишҷӯ Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>5</h3>
                <p>Ўқилаётган фанлар</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>3.8</h3>
                <p>Ўртача баҳо</p>
            </div>
            <div class="icon">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Салом, {{ $user['nom'] }} {{ $user['nasab'] }}</h3>
    </div>
    <div class="card-body">
        Сиз ўз фанларингиз ва баҳо маълумотларингизга кириш имконига эгасиз.
    </div>
</div>
@endsection
