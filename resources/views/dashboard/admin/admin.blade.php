@extends('layouts.app')

@section('title', 'Админ Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $userCount }}</h3>
                <p>Истифодабарандагон</p>
            </div>
            <div class="icon">
                <i class="fas fa-users-cog"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="onlineCount">{{ $onlineCount }}</h3>
                <p>Шахсони онлайн</p>
            </div>
            <div class="icon">
                <i class="fas fa-users-cog"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>10</h3>
                <p>Жадваллар янгиланди</p>
            </div>
            <div class="icon">
                <i class="fas fa-table"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ассалому алайкум, {{ $user['nasab'] }} {{ $user['nom'] }}</h3>
    </div>
    <div class="card-body">
        Шумо ҳамчун админ, имкони дидани мфълумоти ҳамаи истифодабарндагонро доред.
    </div>
</div>

<div class="modal fade" id="onlineUsersModal" tabindex="-1" aria-labelledby="onlineUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="onlineUsersModalLabel">Шахсони онлайн</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="onlineUsersList">
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('onlineCount').addEventListener('click', function() {
        fetch('{{ route("online.users") }}')
            .then(response => response.json())
            .then(data => {
                let userListHtml = '<ul>';
                data.forEach(user => {
                    let userImage = user.surat ? user.surat : 'dist/nobody.jpg';
                    userListHtml += `
                        <li style="list-style: none;">
                            <img src="${userImage}" alt="Surat" style="width: 50px; height: 50px; border-radius: 50%;" />
                            ${user.nasab} ${user.nom} ${user.nomi_padar} (Логин: ${user.login})
                        </li>`;
                });
                userListHtml += '</ul>';
                document.getElementById('onlineUsersList').innerHTML = userListHtml;
                var myModal = new bootstrap.Modal(document.getElementById('onlineUsersModal'));
                myModal.show();
            })
            .catch(error => console.error('Хатогӣ:', error));
    });
</script>
@endsection
