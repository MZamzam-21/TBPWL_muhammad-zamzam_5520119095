@extends('adminlte::page')

@section('title', 'Book PAGE')

@section('content_header')
<h1>BOOK PAGE</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Book Setting') }}

                </div>
                <div class="card-body">
                    <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i> Add Data</button>
                    <a href="{{route('admin.print.books')}}" target="_blank" class="btn btn-secondary mb-5"><i class="fa fa-print"></i>Print to PDF</a>
                    <div class="btn-group mb-5" role="group" aria-label="Basis Example">
                        <a href="{{route('admin.book.export')}}" class="btn btn-info" target="_blank">Exports</a>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#importDataModal">Import</a>
                    </div>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TITLE</th>
                                <th>AUTHOR</th>
                                <th>YEAR</th>
                                <th>PUBLISHER</th>
                                <th>COVER</th>
                                <th>METHOD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($books as $book)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$book->judul}}</td>
                                <td>{{$book->penulis}}</td>
                                <td>{{$book->tahun}}</td>
                                <td>{{$book->penerbit}}</td>
                                <td>
                                    @if($book->cover !== null)
                                    <img src="{{ asset('storage/cover_buku/'.$book->cover) }}" width="100px" />
                                    @else
                                    [Picture Not Found]
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-buku" class="btn" data-toggle="modal" data-target="#editBukuModal" data-id="{{ $book->id }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" id="btn-delete-buku" class="btn" data-toggle="modal" data-target="#deleteBukuModal" data-id="{{ $book->id }}" data-cover="{{ $book->cover }}" data-judul="{{$book->judul}}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.book.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Title</label>
                        <input type="text" class="form-control" name="judul" id="judul" required />
                    </div>
                    <div class="form-group">
                        <label for="penulis">Author</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" required />
                    </div>
                    <div class="form-group">
                        <label for="tahun">Year</label>
                        <input min="1" type="number" id="datepicker" class="form-control" name="tahun" id="tahun" required />
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Publisher</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" required />
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control" name="cover" id="cover" />
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

<div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.book.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-judul">Title</label>
                                <input type="text" class="form-control" name="judul" id="edit-judul" required />
                            </div>
                            <div class="form-group">
                                <label for="edit-penulis">Author</label>
                                <input type="text" class="form-control" name="penulis" id="edit-penulis" required />
                            </div>
                            <div class="form-group">
                                <label for="edit-tahun">Year</label>
                                <input min="1" type="number" id="datepicker" class="form-control" name="tahun" id="edit-tahun" required />
                            </div>
                            <div class="form-group">
                                <label for="edit-penerbit">Publisher</label>
                                <input type="text" class="form-control" name="penerbit" id="edit-penerbit" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="edit-cover">Cover</label>
                                <input type="file" class="form-control" name="cover" id="edit-cover" />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="old_cover" id="edit-old-cover" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data <strong class="font-italic" id="delete-judul"></strong>?
                <form method="post" action="{{ route('admin.book.delete') }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id" value="" />
                <input type="hidden" name="old_cover" id="delete-old-cover" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="importDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.book.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="cover">Upload File</label>
                        <input type="file" class="form-control" name="file">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>



@stop
@section('js')
<script>
    $(function() {
        $("#datepicker").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        $(document).on('click', '#btn-delete-buku', function() {
            let id = $(this).data('id');
            let judul = $(this).data('judul');
            let cover = $(this).data('cover');
            $('#delete-id').val(id);
            $('#delete-old-cover').val(cover);
            $('#delete-judul').text(judul);
            console.log("hallo");
        });



        $(document).on('click', '#btn-edit-buku', function() {
            let id = $(this).data('id');


            $('#image-area').empty();

            $.ajax({
                type: "get",
                url: baseurl + '/admin/ajaxadmin/dataBuku/' + id,
                dataType: 'json',
                success: function(res) {
                    $('#edit-judul').val(res.judul);
                    $('#edit-penerbit').val(res.penerbit);
                    $('#edit-penulis').val(res.penulis);
                    $('#edit-tahun').val(res.tahun);
                    $('#edit-id').val(res.id);
                    $('#edit-old-cover').val(res.cover);

                    if (res.cover !== null) {
                        $('#image-area').append(
                            "<img src='" + baseurl + "/storage/cover_buku/" + res.cover + "' width='200px'/>"
                        );
                    } else {
                        $('#image-area').append('[Gambar tidak tersedia]');
                    }
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