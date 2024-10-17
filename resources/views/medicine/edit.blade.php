@extends('templates.app', ['title' => 'Edit Obat  || APOTEK'])
@section('content-dinamis')
{{-- action route mengirim $item ['id'] untuk spefikasi data di route path {id} --}}
@if (Session::get('failed'))
<div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    <form action="{{ route ('medicine.edit.update',$medicine ['id']) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name" class="form-label">NAMA OBAT</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $medicine['name'] }}">

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group mb-3">
                <label for="type" class="form-label">Tipe obat</label>
                <select name="type" id="type" class="form-select">
                    <option value="tablet" {{ $medicine['type']=='tablet'?'selected': '' }}>Tablet</option>
                    <option value="sirup" {{ $medicine['type']=='sirup'?'selected': '' }}>Sirup</option>
                    <option value="kapsul" {{ $medicine['type']=='kapsul'?'selected': '' }}>Kapsul</option>
                </select>
            </div> 
            @error('type')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $medicine['price'] }}">
            </div>
            @error('price')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            
            <div class="form-group mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $medicine['stock'] }}">
            </div>
            @error('stock')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-primary">Ubah data</button>
        </div>
    </form>
    @endsection