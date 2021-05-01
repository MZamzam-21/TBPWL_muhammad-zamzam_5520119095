@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
<h1 class="text-center text-bold">BARANG</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{ __('Product Setting') }}

        </div>
        <div class="card-body">
          <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Add Data</button>

          <div class="btn-group mb-5" role="group" aria-label="Basis Example">

          </div>
          <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>FOTO</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>MEREK</th>
                <th>HARGA</th>
                <th>STOK</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach($barang as $key)
              <tr>
                <td>{{$no++}}</td>
                <td>
                  @if($key->photo !== null)
                  <img src="{{ asset('storage/photo_barang/'.$key->photo) }}" width="100px" />
                  @else
                  [Picture Not Found]
                  @endif
                </td>
                <td>{{$key->name}}</td>
                <td>{{$key->categories_id}}</td>
                <td>{{$key->brands_id}}</td>
                <td>{{$key->harga}}</td>
                <td>{{$key->stok}}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="btn-edit" class="btn" data-toggle="modal" data-target="#editModalProduk" data-id="{{ $key->id }}" data-name="{{$key->name}}" data-categories_id="{{$key->categories_id}}" data-brands_id="{{$key->brands_id}}" data-harga="{{$key->harga}}" data-stok="{{$key->stok}}"><i class="fa fa-edit"></i></button>
                    <button type="button" id="btn-delete-buku" class="btn" data-toggle="modal" data-target="#deleteModalProduk" data-id="{{ $key->id }}" data-photo="{{ $key->photo }}"><i class="fa fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
        <form method="post" action="{{ route('admin.product.submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" placeholder="Masukan Nama Barang" class="form-control" name="name" id="name" required />
              </div>
              <div class="form-group col-md-6 ml-auto">
                <label for="stok">Jumlah</label>
                <input type="number" min="0" class="form-control" placeholder="Masukan Jumlah" name="stok" id="stok" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="harga">Harga</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" name="harga" id="harga" min="0" placeholder="Masukan Harga" class="form-control" aria-label="Amount (to the nearest dollar)">

            </div>
          </div>
          <div class="form-group">
            <label for="categories_id">Kategori</label>
            <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
            <div class="input-group">
              <select class="custom-select" name="categories_id" id="categories_id" placeholder="Masukan Kategori barang" id="inputGroupSelect04" aria-label="Example select with button addon">
                <option selected>Pilih Kategori</option>
                @php
                $data=App\Models\Categories::get();
                @endphp
                @foreach ($data as $key)
                <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="brands_id">Merek</label>
            <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
            <div class="input-group">
              <select class="custom-select" name="brands_id" id="brands_id" placeholder="Masukan Nama Brands" id="inputGroupSelect04" aria-label="Example select with button addon">
                <option selected>Pilih Merek</option>
                @php
                $data=App\Models\Brands::get();
                @endphp
                @foreach ($data as $key)
                <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="photo">Photo Barang</label>
            <input type="file" class="form-control" placeholder="Masukan Photo barang" name="photo" id="photo" />
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModalProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="edit-nama" required />
              </div>
              <div class="form-group">
                <label for="stok">jumlah</label>
                <input type="text" class="form-control" name="stok" id="edit-stok" required />
              </div>
              <div class="form-group">
                <label for="harga">harga</label>
                <input type="text" class="form-control" name="harga" id="edit-harga" required />
              </div>
              <div class="form-group">
                <label for="categories_id">categori</label>
                <input min="1" type="number" class="form-control" name="categories_id" id="edit-categori" required />
              </div>
              <div class="form-group">
                <label for="brands_id">Brands</label>
                <input min="1" type="number" class="form-control" name="brands_id" id="edit-brands" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="image-area"></div>
              <div class="form-group">
                <label for="photo">gambar</label>
                <input type="file" class="form-control" name="photo" id="edit-gambar" />
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="edit-id" />
        <input type="hidden" name="old_photo" id="edit-old-photo" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteModalProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        Apakah anda yakin akan menghapus data <strong class="font-italic"></strong>?
        <form method="post" action="{{ route('admin.product.delete') }}" enctype="multipart/form-data">
          @csrf
          @method('DELETE')
      </div>

      <div class="modal-footer">
        <input type="hidden" name="id" id="delete-id" value="" />
        <input type="hidden" name="old_photo" id="delete-old-photo" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>

</div>





@stop
@section('js')
<script>
  $(function() {
    
    $(document).on('click', '#btn-delete-buku', function() {
      let id = $(this).data('id');
      let cover = $(this).data('cover');
      $('#delete-id').val(id);
      $('#delete-old-cover').val(cover);
      console.log("hallo");
    });


    $(document).on('click', '#btn-edit', function() {
      let id = $(this).data('id');
      let name = $(this).data('name');
      let categories_id = $(this).data('categories_id');
      let brands_id = $(this).data('brands_id');
      let stok = $(this).data('stok');
      let harga = $(this).data('harga');
      let photo = $(this).data('photo');

      $('#image-area').empty();
            $('#edit-nama').val(name);
            $('#edit-harga').val(harga);
            $('#edit-categori').val(categories_id);
            $('#edit-brands').val(brands_id);
            $('#edit-stok').val(stok);
            $('#edit-id').val(id);
            $('#edit-old-photo').val(photo);
            if (photo !== null) {
                $('#image-area').append(
                    "<img src='" + baseurl + "/storage/photo_barang/" + photo + "' width='200px'/>"
                );
            } else {
                $('#image-area').append('[Gambar tidak tersedia]');
            }

      

    
    });
    

  });
</script>
@stop
@section('js')
<script>

</script>
@stop