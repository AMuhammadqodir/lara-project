<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Kutubxona Tizimi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #667eea, #764ba2);
        font-family: 'Segoe UI', sans-serif;
        overflow: hidden;
    }
    /* Particle effect */
    .particle {
        position: absolute;
        width: 15px;
        height: 15px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        animation: float 6s infinite;
    }
    @keyframes float {
        0% { transform: translateY(0) translateX(0); opacity:1; }
        50% { transform: translateY(-200px) translateX(50px); opacity:0.5; }
        100% { transform: translateY(0) translateX(-50px); opacity:1; }
    }

    .card {
        position: relative;
        z-index: 2;
        border-radius: 1.2rem;
        padding: 2.5rem;
        background: rgba(255,255,255,0.95);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        0% {opacity:0; transform: translateY(-30px);}
        100% {opacity:1; transform: translateY(0);}
    }

    .form-control:focus {
        border-color: #764ba2;
        box-shadow: 0 0 10px rgba(118,75,162,0.5);
    }

    .btn-primary {
        background: linear-gradient(90deg, #667eea, #764ba2);
        border: none;
        border-radius: 50px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #764ba2, #667eea);
    }

    .logo {
        font-size: 2rem;
        font-weight: bold;
        color: #fff;
        text-align: center;
        margin-bottom: 1.5rem;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.4);
        z-index: 2;
        position: relative;
    }

    @media (max-width: 576px) {
        .card { padding: 1.5rem; }
    }
</style>
</head>
<body>

<!-- Particle background -->
<div class="particle" style="top:10%; left:20%;"></div>
<div class="particle" style="top:30%; left:70%;"></div>
<div class="particle" style="top:60%; left:40%;"></div>
<div class="particle" style="top:80%; left:80%;"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="logo">📖Системаи омӯзиш</div>
                <h4 class="text-center mb-4">Воридшавӣ</h4>

                <!-- Xatoliklar -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Muvaffaqiyat xabari -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" name="login" id="login" class="form-control" placeholder="👤 Логин" required>
                    </div>

                    <div class="mb-3">
                        <label for="parol" class="form-label">Парол</label>
                        <input type="password" name="parol" id="parol" class="form-control" placeholder="🔒 Парол" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Воридшавӣ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
