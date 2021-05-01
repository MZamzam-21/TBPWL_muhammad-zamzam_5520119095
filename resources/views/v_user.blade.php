@extends('adminlte::page')

@section('title', 'Page User')

@section('content_header')
<h1 class="text-center text-bold">USER</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('User Setting') }}

                </div>
                <div class="card-body">
                    <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#modalTambahUser"><i class="fa fa-plus"></i> Tambah User</button>
                    <div class="btn-group mb-5" role="group" aria-label="Basis Example">
                    </div>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>FOTO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>ROLES</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($users as $pengguna)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>
                                    @if($pengguna->photo !== null)
                                    <img src="{{ asset('storage/photo_user/'.$pengguna->photo) }}" width="100px" />
                                    @else
                                    [Picture Not Found]
                                    @endif
                                </td>
                                <td>{{$pengguna->name}}</td>
                                <td>{{$pengguna->email}}</td>
                                <td>{{$pengguna->password}}</td>
                                <td>{{$pengguna->roles_id}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-user" class="btn" data-toggle="modal" data-target="#modalEdit" data-id="{{ $pengguna->id }}" data-photo="{{$pengguna->photo}}" data-name="{{$pengguna->name}}" data-username="{{$pengguna->username}}" data-email="{{$pengguna->email}}" data-password="{{$pengguna->password}}" data-roles_id="{{$pengguna->roles_id}}"><i class="fa fa-edit"></i></button>
                                        <button type="button" id="btn-delete-user" class="btn" data-toggle="modal" data-target="#modalDelete" data-id="{{ $pengguna->id }}" data-photo="{{ $pengguna->photo }}" data-name="{{$pengguna->name}}"><i class="fa fa-trash"></i></button>
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

<!-- Modal Tambah User  -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.user.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group .col-md-6 mr-5">
                                <label for="name">Nama</label>
                                <input type="text" placeholder="Masukan Nama" class="form-control" name="name" id="name" required />
                            </div>
                            <div class="form-group .col-md-6 .ml-auto">
                                <label for="username">Username</label>
                                <input type="text" placeholder="Masukan username" class="form-control" name="username" id="username" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Masukan Email" name="email" id="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input min="1" type="password" class="form-control" placeholder="Masukan password" name="password" id="password" required />
                    </div>
                    <div class="form-group">
                        <label for="roles_id">Role</label>
                        <div class="input-group">
                            <select class="custom-select" name="roles_id" placeholder="Masukan role anda" id="roles_id" aria-label="Example select with button addon">
                                <option selected>Pilih...</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>

                        </div>
                        <!-- <div class="input-group">
                            <input type="text" name="roles_id" id="roles_id" class="form-control" aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#roles_id" aria-valuetext="Admin">Admin</a>
                                    <a class="dropdown-item" href="#roles_id" aria-valuetext="User">User</a>

                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" class="form-control" placeholder="Masukan foto anda" name="photo" id="photo" />
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah User  -->

<!-- Modal Edit User -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.user.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required />
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="edit-username" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="edit-email" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password lama</label>
                                <input min="0" type="text" class="form-control" name="password" id="edit-password" required />
                            </div>
                            <div class="form-group">
                                <label for="roles_id">Role</label>
                                <div class="input-group">
                                    <select class="custom-select" name="roles_id" id="edit-roles_id" aria-label="Example select with button addon">
                                        <option selected>Pilih...</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>

                                </div>
                                <!-- <div class="input-group">
                                    <input type="text" name="roles_id" id="edit-roles_id" class="form-control" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#roles_id" aria-valuetext="Admin">Admin</a>
                                            <a class="dropdown-item" href="#roles_id" aria-valuetext="User">User</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="edit-photo">photo</label>
                                <input type="file" class="form-control" name="photo" id="edit-photo" />
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
<!-- Modal Edit User -->

<!-- Modal Delete User -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data <strong class="font-italic" id="delete-name"></strong>?
                <form method="post" action="{{ route('admin.user.delete') }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id" value="" />
                <input type="hidden" name="old_photo" id="delete-old-photo" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete User -->



@stop

@section('js')
<script>
    $(function() {

        $(document).on('click', '#btn-edit-user', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let username = $(this).data('username');
            let email = $(this).data('email');
            let password = $(this).data('password');
            let roles_id = $(this).data('roles_id');
            let photo = $(this).data('photo');

            $('#image-area').empty();
            $('#edit-name').val(name);
            $('#edit-username').val(username);
            $('#edit-email').val(email);
            $('#edit-password').val(password);
            $('#edit-roles_id').val(roles_id);
            $('#edit-id').val(id);
            $('#edit-old-photo').val(photo);
            if (photo !== null) {
                $('#image-area').append(
                    "<img src='" + baseurl + "/storage/photo_user/" + photo + "' width='200px'/>"
                );
            } else {
                $('#image-area').append('[Gambar tidak tersedia]');
            }


            // $.ajax({
            //     type: "get",
            //     url: baseurl + '/admin/ajaxadmin/dataUser/' + id,
            //     dataType: 'json',
            //     success: function(res) {
            //         console.log(res);
            //         $('#edit-name').val(res.name);
            //         $('#edit-username').val(res.username);
            //         $('#edit-email').val(res.email);
            //         $('#edit-password').val(res.password);
            //         $('#edit-roles_id').val(res.roles_id);
            //         $('#edit-id').val(res.id);
            //         $('#edit-old-photo').val(res.photo);

            //         if (res.photo !== null) {
            //             $('#image-area').append(
            //                 "<img src='" + baseurl + "/storage/photo_user/" + res.photo + "' width='200px'/>"
            //             );
            //         } else {
            //             $('#image-area').append('[Gambar tidak tersedia]');
            //         }
            //     },
            // });
        });

        $(document).on('click', '#btn-delete-user', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let username = $(this).data('username');
            let email = $(this).data('email');
            let password = $(this).data('password');
            let roles_id = $(this).data('roles_id');
            let photo = $(this).data('photo');
            $('#delete-id').val(id);
            $('#delete-old-photo').val(photo);
            $('#delete-name').text(name);
            console.log("hallo");
        });

    });
</script>
@stop