@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Шахсий маълумотлар</h3>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group w-50">
                <label>Ном</label>
                <input type="text" name="nom" class="form-control" value="{{ $ist->nom }}" required>
            </div>
            <div class="form-group w-50">
                <label>Насаб</label>
                <input type="text" name="nasab" class="form-control" value="{{ $ist->nasab }}" required>
            </div>
            <div class="form-group w-50">
                <label>Номи падар</label>
                <input type="text" name="nomi_padar" class="form-control" value="{{ $ist->nomi_padar }}">
            </div>
            <div class="form-group w-50">
                <label>Ҷинс</label>
                <select name="jins" class="form-control" required>
                    <option value="Мард" {{ $ist->jins == 'Мард' ? 'selected' : '' }}>Мард</option>
                    <option value="Зан" {{ $ist->jins == 'Зан' ? 'selected' : '' }}>Зан</option>
                </select>
            </div>
            <div class="form-group w-50">
                <label>Шаҳр/ноҳия</label>
                <select name="maqom_id" class="form-control" required>
                    @foreach($s_nohiya as $sn)
                        <option value="{{ $sn->sn_id }}" {{ $ist->shahr_nohiya == $sn->sn_id ? 'selected' : '' }}>
                            {{ $sn->shahr_nohiya }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group w-50">
                <label>Мақом</label>
                <select name="maqom_id" class="form-control" required>
                    @foreach($maqom as $m)
                        <option value="{{ $m->maqom_id }}" {{ $ist->maqom_id == $m->maqom_id ? 'selected' : '' }}>
                            {{ $m->nomi_maqom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 w-50">
                <label>Сурат</label><br>
                @if($ist->surat)
                    <img src="{{ asset($ist->surat) }}" alt="User photo" width="100" class="mb-2 rounded">
                @endif
                <input type="file" name="surat" class="form-control">
            </div>
            <div class="form-group w-50">
                <label>Парол (агар хоҳед, ки нав кунед)</label>
                <input type="password" name="parol" class="form-control">
            </div>
            <div class="form-group w-50">
                <label>Тасдиқи парол</label>
                <input type="password" name="parol_confirmation" class="form-control">
            </div>
            <div class="form-group w-50">
                <button type="submit" class="btn btn-primary mb-3">Сабт</button>
                <a href="{{ route('maqom.admin') }}" class="btn btn-warning mb-3">Бекоркунӣ</a>
            </div>
            
        </div>
        
    </form>
</div>
@endsection
