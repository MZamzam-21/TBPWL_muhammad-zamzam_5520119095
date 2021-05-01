@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($user->roles_id==1)
                    Your loged as admin

                    @else ($user->roles_id ==2)
                    Your loged as user
                    <!-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> -->
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
</div>
<strong>CopyRight &copy; {{date('Y')}}
    <a href="#" target="_blank">Muhammad Zamzam Maulana</a>.</strong> All Right reserved
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!')
</script>
@stop