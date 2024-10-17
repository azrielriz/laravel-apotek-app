@extends('templates.app', ['title' => 'obat || Apotek'])

@section('content-dinamis')
<div class="my-3">
    <a href="{{ route('medicine.add') }}" class="btn btn-success mb-3">+tambah</a>
    @if (Session::get('success'))
    <div class="alert alert-danger">{{session::get('success')}}</div>
@endif
    <table class="table table-bordered table-stripped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama obat</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>stock</th>
                <th>aksi</th>
            </tr>
        </thead>
        <body>
            @if (count($medicine))
            
            @foreach ($medicine as $index => $item)
            <tr>
                <td>{{ ($medicine->currentPage()-1) * ($medicine->perPage()+1) + ($index+1) }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['type'] }}</td>
                <td>Rp{{ number_format ($item['price'], 0,',','.' )}}</td>
                <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white': 'bg-success text-dark'}}" onclick="editStock({{ $item['id'] }}),{{ $item['stock'] }}">
                  <span  style="cursor:pointer; text-decoration:underline !important">
                  {{ $item['stock'] }}
                </span>
                
                </td>
                <td class="d-flex justify-content-center py-1">
                    <a href="{{ route('medicine.edit',$item['id']) }}" class="btn btn-primary mr-3">Edit</a>
                    <button type="submit" class="btn btn-danger" onclick="showModal('{{ $item->id }}','{{ $item->name }}')">Delete</button>
                </td>
                <td></td>
            </tr>
            @endforeach
            
            
            @else
            <tr>
                <td colspan="5" class="text-bold">Data obat Kosong</td>
            </tr>
            
            
            @endif
            
            
        </body>
    
    </table>

    {{ $medicine->links() }}
</div>

<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form id="form-delete-obat" method="POST">
            @csrf
            {{-- menimpa method "POST"diganti menjadi delete,sesuai deangan http method untuk menghapus data --}}
            @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="warning-delete" id="exampleModalLabel">Warning delete </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          apakah anda yakin ingin menghapus data obat <span id="nama-obat"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Simpan</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </form> 
    </div>
  </div>
  <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-edit-stock" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStockLabel">Edit Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="medicine-id">
                    <div class="form-group">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
        let action = '{{ route("medicine.delete", ":id") }}';
        action =action.replace(':id',id)
        $('#form-delete-obat').attr('action', action);
        // munculkan modal yang id nya exampleModal
        $('#exampleModal').modal('show');
        // inner text pada element html id nama-obat
        console.log(name);
        $('#nama-obat').text(name);
    }
    function editStock(id,stock){
      $('#medicine-id').val(id);
      $('#stock').val(stock);
      $('#editStockModal').modal('show');
    }
    $('#form-edit-stock').on('submit',function(e){
      e.preventDefault();
      let id = $('#medicine-id').val();
      let stock = $('#stock').val();
      let actionUrl = '{{url( "/Medicines/update-stock") }}/' + id;

      $.ajax({
        url:actionUrl,
        type: 'PUT',
        data:{
          _token: '{{ csrf_token() }}',
          stock:stock
        },
        success:function(response){
          $('#editStockModal').modal('hide');
          alert ('berhasil update stock');
          location.reload();
        },
        error:function(xhr){
          alert('stock tidak boleh kosong')
        }
      });
    });
    </script>
@endpush
