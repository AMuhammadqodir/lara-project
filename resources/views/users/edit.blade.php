@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Таҳрири маълумоти истифодабаранда</h3>
        </div>

        <form action="{{ route('users.update', $user->uid) }}" method="POST">
            @csrf
            @method('PUT')
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
                    <input type="text" name="nom" class="form-control" value="{{ $user->nom }}" required>
                </div>
                <div class="form-group">
                    <label>Насаб</label>
                    <input type="text" name="nasab" class="form-control" value="{{ $user->nasab }}" required>
                </div>
                <div class="form-group">
                    <label>Номи падар</label>
                    <input type="text" name="nomi_padar" class="form-control" value="{{ $user->nomi_padar }}">
                </div>
                <div class="form-group">
                    <label>Ҷинс</label>
                    <select name="jins" class="form-control" required>
                        <option value="Мард" {{ $user->jins == 'Мард' ? 'selected' : '' }}>Мард</option>
                        <option value="Зан" {{ $user->jins == 'Зан' ? 'selected' : '' }}>Зан</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Шаҳр/ноҳия</label>
                    <select name="maqom_id" class="form-control" required>
                        @foreach($s_nohiya as $sn)
                            <option value="{{ $sn->sn_id }}" {{ $user->shahr_nohiya == $sn->sn_id ? 'selected' : '' }}>
                                {{ $sn->shahr_nohiya }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Мақом</label>
                    <select name="maqom_id" class="form-control" required>
                        @foreach($maqom as $m)
                            <option value="{{ $m->maqom_id }}" {{ $user->maqom_id == $m->maqom_id ? 'selected' : '' }}>
                                {{ $m->nomi_maqom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Парол (агар хоҳед, ки нав кунед)</label>
                    <input type="password" name="parol" class="form-control">
                </div>
                <div class="form-group">
                    <label>Тасдиқи парол</label>
                    <input type="password" name="parol_confirmation" class="form-control">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Сабт</button>
            </div>
        </form>
    </div>
</div>
@endsection
