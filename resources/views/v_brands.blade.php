@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')
<h1 class="text-center text-bold">BRAND</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Brands Setting') }}

                </div>
                <div class="card-body">
                    <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Add Data</button>

                    <div class="btn-group mb-5" role="group" aria-label="Basis Example">

                    </div>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA BRAND</th>
                                <th>KETERANGAN</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($merek as $key)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$key->name}}</td>
                                <td>{{$key->description}}</td>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-brands" class="btn" data-toggle="modal" data-target="#modalEdit" data-id="{{ $key->id }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" id="btn-delete-brands" class="btn" data-toggle="modal" data-target="#modalDelete" data-id="{{ $key->id }}" data-name="{{ $key->name }}"><i class="fa fa-trash"></i></button>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Brands</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.brand.apply') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Brands</label>
                        <input type="text" class="form-control" placeholder="Masukan nama Merek" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea class="form-control" aria-label="With textarea" placeholder="Masukan keterangan merek" name="description" id="description" required></textarea>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Data -->


<!-- Modal Edit Data -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Brands</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.brand.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="edit-name">NAMA BRAND</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required />
                            </div>
                            <div class="form-group">
                                <label for="edit-description">KETERANGAN</label>
                                <textarea class="form-control" aria-label="With textarea" name="description" id="edit-description" required></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Data -->


<!-- Modal Delete Data -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Brands</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Data Brand <strong class="" id="delete-nama"></strong>?
                <form method="post" action="{{ route('admin.brand.delete') }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id" value="" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete Data -->




@stop
@section('js')
<script>
    $(function() {
        $("#datepicker").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        $(document).on('click', '#btn-delete-brands', function() {
            let id = $(this).data('id');
            let nama = $(this).data('name');
            $('#delete-id').val(id);
            $('#delete-nama').text(nama);
            console.log("hallo");
        });


        $(document).on('click', '#btn-edit-brands', function() {
            let id = $(this).data('id');

            $.ajax({
                type: "get",
                url: baseurl + '/admin/ajaxadmin/dataBrands/' + id,
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#edit-name').val(res.name);
                    $('#edit-description').val(res.description);
                    $('#edit-id').val(res.id);
                },
            });
        });

    });
</script>
@stop
@section('js')
<script>

</script>
@stop