@extends('templates.app', ['title'=>'landing || login'])
@section('content-dinamis')
@push('style')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-container {
        max-width: 500px; /* Lebar diperbesar */
        margin: 50px auto;
        padding: 20px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border: none;
        background-color: #fff;
    }
    .card-header {
        background-color: transparent;
        border-bottom: none;
        padding-bottom: 10px;
    }
    .card-header h4 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }
    .card-body {
        padding: 30px 25px;
    }
    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 12px 18px;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        border-color: #007bff;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        padding: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .card-footer {
        background-color: transparent;
        border-top: none;
        font-size: 14px;
        color: #777;
        padding-top: 0;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #555;
    }
    .card-footer small {
        font-size: 13px;
        color: #aaa;
    }
    .eye-icon {
        position: absolute;
        right: 10px;
        top: 35%;
        cursor: pointer;
        font-size: 20px;
    }
    .login-container .register-link {
    text-align: center;
    margin-top: 20px;
}

.login-container .register-link a {
    color: #007bff;
    text-decoration: none;
    font-size: 14px;
}

.login-container .register-link a:hover {
    text-decoration: underline;
}
</style>
@endpush


<div class="login-container">
    <div class="card">
        <div class="card-header text-center">
            <h4 class="mb-0">Login</h4>
            <h6>silahkan login terlebih dahulu sebagai absensi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('Users.tambah.akun') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda">
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda">
                </div>
                
                <div class="mb-2 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password anda">
                    <span class="eye-icon" onclick="togglePassword()">
                        👁️
                    </span>
                </div>

                <div class="form-group">
                    <label for="role" class="form-label">jabatan</label>
                    <select name="role" id="role" class="form-select">
                        <option hidden selected disabled>pilih</option>
                        <option value="admin"  value="{{ old('role') == 'admin' ? 'selected' : '' }}">Admin</option>
                        <option value="kasir"  value="{{ old('role') ==  'kasir' ? 'selected' :'' }}">Kasir</option>
                    </select>
                </div>
                
                {{-- <div class="d-grid">
                    <a href="{{ route('Users') }}" class="btn btn-success mb-3">login</a>
                    @if (Session::get('success'))
                    <div class="alert alert-danger">{{session::get('success')}}</div>
                @endif --}}

                <button type="submit" class="btn btn-success mt-3">submit</button>

                </div>
            </form>
        </div>
        <div class="register-link">
            <a href="/register">Belum punya akun? Daftar di sini</a>
        </div>
    </div>w
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.querySelector(".eye-icon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.textContent = "🙈"; // Mengganti ikon saat password terlihat
        } else {
            passwordInput.type = "password";
            eyeIcon.textContent = "👁️"; // Mengganti ikon saat password tersembunyi
        }
    }
</script>

@endsection
