@extends('templates.app', ['title' => 'Obat || APOTEK'])

@section('content-dinamis')
    <a href="{{ route('Users.absen') }}" class="btn btn-success mb-3">+tambah</a>
        @if (Session::get('success'))
    <div class="alert alert-danger">{{session::get('success')}}</div>
        @endif
    <div>    
        <div class="table-responsive">
            <table class="table table-bordered table-stripped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>

                    </tr>
                </thead>

                <body>
                    @php
                        $number=1;
                    @endphp
                    @foreach ($users as $index => $absens)
                        <tr>
                            {{-- <td>{{ ($medicines->currentPage() - 1) * $medicines->perpage() + ($index + 1) }}</td> --}}
                            {{-- $item['nama_field_migration'] --}}
                            <td>{{$number++}}</td>
                            <td>{{ $absens['name'] }}</td>
                            <td>{{ $absens['email'] }}</td>
                            <td>{{ $absens['role'] }}</td>
                            <td class="d-flex justify-content-center py-1">
                                <a href="{{ route('Users.absen', $absens['id']) }}">  </a>
                                  
                            </td>
                            <td class="d-flex justify-content-center py-1">
                                {{-- <a href="{{ route('medicine.edit',$item['id']) }}" class="btn btn-primary mr-3">Edit</a> --}}
                                <a href="{{ route('Users.edit',$absens['id']) }}" class="btn btn-primary mr-3">Edit</a>
                                <button type="submit" class="btn btn-danger" onclick="showModal('{{ $absens->id }}','{{ $absens->name }}')">Delete</button>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form id="form-delete-akun" method="POST">
                    @csrf
                    {{-- menimpa method "POST"diganti menjadi delete,sesuai deangan http method untuk menghapus data --}}
                    @method('DELETE')
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="warning-delete" id="exampleModalLabel">Warning delete </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  apakah anda yakin ingin menghapus akun <span id="nama-akun"></span>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Simpan</button>
                  <button type="submit" class="btn btn-primary">Delete</button>
                </div>
              </div>
            </form> 
            </div>
          </div>

@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

{{-- fungsi untuk menampilkan model --}}
    <script>
    function showModal(id,name){
        let action = '{{ route("Users.delete", ":id") }}';
        action =action.replace(':id',id)
        $('#form-delete-akun').attr('action', action);
        // munculkan modal yang id nya exampleModal
        $('#exampleModal').modal('show');
        // inner text pada element html id nama-obat
        console.log(name);
        $('#nama-akun').text(name);
    }
    </script>
@endpush
 