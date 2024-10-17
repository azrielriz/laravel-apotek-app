@extends('templates.app', ['title' => 'Obat || APOTEK'])

@section('content-dinamis')
 <form action="{{ route('login.auth') }}" method="POST" class="card w-75 d-block mx-auto-my-3 p-4 shadow">
    @csrf
    @if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        
    @endif
    <div class="card-body">
        <h3 class="card-title text-center">Login</h3>
        <div class="form-group">
            <label for="email" class="from-label">EMAIL</label>
            <input type="email" name="email" id="email" class="from-control">
            @error('email')
            <span class="text-danger">{{ $message }}</span>               
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" class="from-control">
            @error('password')
            <span class="text-danger">{{ $message }}</span>                
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>

    </div>
 </form>
    
@endsection