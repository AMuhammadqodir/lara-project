<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">

        <!-- Foydalanuvchi menyusi -->
        <li class="nav-item dropdown user-menu">
            <a href="{{ route('profile') }}" class="nav-link dropdown-toggle" data-toggle="dropdown">
            @php
                $user = session('user');
                $imagePath = isset($user['surat']) && file_exists(public_path($user['surat']))
                    ? asset($user['surat'])
                    : asset('dist/nobody.jpg');
            @endphp

            <img src="{{ $imagePath }}" class="user-image img-circle elevation-2" alt="User Image">


                     <span class="d-none d-md-inline">
                        @php $user = session('user'); @endphp
                        {{ isset($user['nomi_padar']) 
                            ? $user['nasab'] . ' ' . $user['nom'] . ' ' . $user['nomi_padar'] 
                            : $user['nasab'] . ' ' . $user['nom'] }}
                    </span>

            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Foydalanuvchi profili -->
                <li class="user-header bg-primary">
                @php
                    $user = session('user');
                    $imagePath = isset($user['surat']) && file_exists(public_path($user['surat']))
                        ? asset($user['surat'])
                        : asset('dist/nobody.jpg');
                @endphp

                <img src="{{ $imagePath }}" class="user-image img-circle elevation-2" alt="User Image">
                    <p>
                        {{ session('user.nasab') }} {{ session('user.nom') }}
                        <small>{{ session('user.maqom_nomi') ?? 'Фойдаланувчи' }}</small>
                    </p>
                </li>

                <!-- Menyu pastki qismi -->
                <li class="user-footer">
                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Профил</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Чиқиш
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        <!-- /Foydalanuvchi menyusi -->

    </ul>
</nav>

