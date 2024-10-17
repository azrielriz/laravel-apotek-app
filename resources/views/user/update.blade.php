@extends('templates.app', ['title' => 'Edit Akun  || KELOLA AKUN'])
@section('content-dinamis')
{{-- action route mengirim $item ['id'] untuk spefikasi data di route path {id} --}}
@if (Session::get('failed'))
<div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    <form action="{{ route ('Users.edit.update',$akun ['id']) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name" class="form-label">NAMA AKUN</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $akun['name'] }}">

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group mb-3">
                <label for="type" class="form-label">Jabatan</label>
                <select name="type" id="type" class="form-select">
                    <option hidden selected disabled>pilih</option>
                        <option value="admin"   {{ $akun['role'] == 'admin' ? 'selected' : '' }}">Admin</option>
                        <option value="kasir"  {{  $akun ['role'] ==  'kasir' ? 'selected' :'' }}">Kasir</option>
                </select>
            </div> 
            @error('type')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $akun['email'] }}">
            </div>
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            
            <button type="submit" class="btn btn-primary">Ubah data</button>
        </div>
    </form>
    @endsection