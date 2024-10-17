@extends('templates.app', ['title' => 'Tambah Obat || Apotek'])
@section('content-dinamis')
   <div class="m-auto" style="width: 65%">
    <form class="p-4 mt-2" style="border: 1px solid black" action="" method="POST">

        @if (Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ol>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                        
                    @endforeach
                </ol>
            </div>
            
        @endif
        {{-- Aturan form menambahkan/mengubah/menghapus :
        1.method POST
        2.namenya diambil dari nama field di migration
        3.harus ada @scrf dibawah <form> : headers token mengirim data POST
        4.form search, action halaman return view, form selain search isi action harus berada dengan return view(bukan ke route yang return view halaman create) --}}
        
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nama obat</label>
            <input type="text" name="name" id="name" class="form-control" value=" {{ old('name') }}">
            
        </div>
        <div class="form-group">
            <label for="type" class="form-label">Tipe obat</label>
            <select name="type" id="type" class="form-select">
                <option hidden selected disabled>pilih</option>
                <option value="tablet"  value="{{ old('type') == 'tablet' ? 'selected' : '' }}">tablet</option>
                <option value="sirup"   value="{{ old('type') ==  'sirup' ? 'selected' :'' }}">Sirup</option>
                <option value="Kapsul"  value="{{ old('type') == 'kapsul' ? 'selected' : '' }}">Kapsul</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Harga Obat</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="form-control">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
        </div>
        <button type="submit" class="btn btn-success mt-3">submit</button>
    </form>
   </div>
    
@endsection