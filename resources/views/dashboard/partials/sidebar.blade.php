<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('login') }}" class="brand-link">
        <span class="brand-text font-weight-bolder" style="color: rgba(123, 176, 245, 0.658);">СА - ДДХ</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                @php $user = session('user'); @endphp
                @if($user)
                    
                    @if($user['maqom_id'] == 1)
                        <li class="nav-item"><a href="{{ route('maqom.rector') }}" class="nav-link">Ректор</a></li>
                    @elseif($user['maqom_id'] == 2)
                        <li class="nav-item"><a href="{{ route('maqom.admin') }}" class="nav-link">⚙️ Админ</a></li>
                    @elseif($user['maqom_id'] == 3)
                        <li class="nav-item"><a href="{{ route('maqom.muallim') }}" class="nav-link">Муаллим</a></li>
                    @elseif($user['maqom_id'] == 4)
                        <li class="nav-item"><a href="{{ route('maqom.donishju') }}" class="nav-link">Донишҷӯ</a></li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                           🚪 Баромад
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @if(in_array($user['maqom_id'], [1, 2]))
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Маълумоти истифодабарандагон</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Иловаи истифодабаранда</p>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </nav>
    </div>
</aside>
