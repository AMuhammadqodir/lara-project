@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Шахсий маълумотлар</h3>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Исми</label>
            <input type="text" name="nom" class="form-control" value="{{ $foydalanuvchi->nom }}">
        </div>

        <div class="form-group mb-3">
            <label>Насаб</label>
            <input type="text" name="nasab" class="form-control" value="{{ $foydalanuvchi->nasab }}">
        </div>

        <div class="form-group mb-3">
            <label>Сурат</label><br>
            @if($foydalanuvchi->surat)
                <img src="{{ asset($foydalanuvchi->surat) }}" alt="User photo" width="100" class="mb-2 rounded">
            @endif
            <input type="file" name="surat" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Янгилаш</button>
    </form>
</div>
@endsection
