@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold; font-size: 25px; " align="center">Рӯйхати истифодабарандагон</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>UID</th>
                        <th>Логин</th>
                        <th>Ном</th>
                        <th>Насаб</th>
                        <th>Номи падар</th>
                        <th>Мақом</th>
                        <th>Ҷинс</th>
                        <th>Амалиёт</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->uid }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->nasab }}</td>
                            <td>{{ $user->nomi_padar }}</td>
                            <td>{{ $user->nomi_maqom }}</td>
                            <td>{{ $user->jins }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->uid) }}" class="btn btn-sm btn-warning">Таҳрир</a>
                                <form action="{{ route('users.destroy', $user->uid) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">Хориҷ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
