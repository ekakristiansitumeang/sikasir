<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MasKasir</title>
    
    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            /* Membuat background gradient biru keren */
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .card-header {
            background: white;
            border-bottom: none;
            text-align: center;
            padding-top: 30px;
            border-radius: 15px 15px 0 0 !important;
        }
        .brand-icon {
            font-size: 50px;
            color: #0d6efd;
            margin-bottom: 10px;
        }
        .btn-login {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }
        .form-control {
            border-radius: 0 10px 10px 0;
            padding: 10px;
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background-color: #f8f9fa;
            border-right: none;
        }
        /* Hapus border kanan icon agar menyatu dengan input */
        .input-group-text + .form-control {
            border-left: none; 
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }
    </style>
</head>
<body>

    <div class="card login-card p-3">
        {{-- LOGO / HEADER --}}
        <div class="card-header">
            <div class="brand-icon">
                <i class="fas fa-cash-register"></i>
            </div>
            <h4 class="fw-bold text-dark">MasKasir Login</h4>
            <p class="text-muted small">Masuk untuk memulai sesi penjualan</p>
        </div>

        <div class="card-body">
            {{-- ALERT ERROR --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show text-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                {{-- INPUT ID PEGAWAI --}}
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="fas fa-user"></i></span>
                        <input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai (Contoh: PEG001)" required autofocus autocomplete="off">
                    </div>
                </div>
                
                {{-- INPUT PASSWORD --}}
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>

                {{-- TOMBOL LOGIN --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-login">
                        MASUK SEKARANG <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>

            </form>
        </div>
        
        <div class="card-footer bg-white border-0 text-center pb-3">
            <small class="text-muted">Aplikasi Kasir v1.0 &copy; {{ date('Y') }}</small>
        </div>
    </div>

    {{-- Script Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>