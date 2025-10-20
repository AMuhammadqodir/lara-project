<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            border-radius: 50px;
            font-weight: 600;
        }
        @media (max-width: 576px) {
            .card { margin: 1rem; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-9">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">📝 Сабт аз рӯйхат</h3>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Ном</label>
                        <input type="text" name="nom" class="form-control" placeholder="Номи худро ворид кунед" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Насаб</label>
                        <input type="text" name="nasab" class="form-control" placeholder="Насаби худро ворид кунед" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Номи падар</label>
                        <input type="text" name="nomi_padar" class="form-control" placeholder="Номи падар">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ҷинс</label>
                        <select name="jins" class="form-select" required>
                            <option value="" selected disabled>Интихоб...</option>
                            <option value="Мард">🚹 Мард</option>
                            <option value="Зан">🚺 Зан</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🏢 Шаҳр / Ноҳия</label>
                        <select name="shahr_nohiya" class="form-select" required>
                            <option value="" disabled selected>Интихоб кунед...</option>
                            @foreach($shahr_nohiya as $shahr)
                                <option value="{{ $shahr->sn_id }}">{{ $shahr->shahr_nohiya }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Мақом</label>
                        <select name="maqom_id" class="form-select" required>
                            <option value="" disabled selected>Интихоб кунед...</option>
                            @foreach($maqom as $item)
                                <option value="{{ $item->maqom_id }}">{{ $item->tojiki }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🔐 Парол</label>
                        <input type="password" name="parol" class="form-control" placeholder="Парол ворид кунед" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">🔐 Такрори парол</label>
                        <input type="password" name="parol_confirmation" class="form-control" placeholder="Паролро такрор ворид кунед" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">📥 Сабт</button>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0">Агар аллакай сабт шуда бошед? 
                        <a href="{{ route('login') }}" class="text-primary fw-bold">Воридшавӣ</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
