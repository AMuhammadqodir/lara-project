@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Иловаи истифодабандаи нав</h3>
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                    <label>Ном</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Насаб</label>
                    <input type="text" name="nasab" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Номи падар</label>
                    <input type="text" name="nomi_padar" class="form-control">
                </div>
                <div class="form-group">
                    <label>Ҷинс</label>
                    <select name="jins" class="form-control" required>
                        <option value="Мард">Мард</option>
                        <option value="Зан">Зан</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Шаҳр/ноҳия</label>
                    <select name="sn_id" class="form-control" required>
                        @foreach($s_nohiya as $sn)
                            <option value="{{ $sn->sn_id }}">{{ $sn->shahr_nohiya }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Мақом</label>
                    <select name="maqom_id" class="form-control" required>
                        @foreach($maqom as $m)
                            <option value="{{ $m->maqom_id }}">{{ $m->nomi_maqom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Парол</label>
                    <input type="password" name="parol" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Тадиқи парол</label>
                    <input type="password" name="parol_confirmation" class="form-control" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Сабт</button>
            </div>
        </form>
    </div>
</div>
@endsection
