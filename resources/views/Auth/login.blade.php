@extends('auth.layout')

@section('title','Login')

@section('title-auth')
    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
        <span>Login</span>
    </h6>
@endsection                                
@section('content')

<form class="form p-3 pb-0" style="margin-top: -20px" method="post" action="{{route('auth.action.login')}}">
    @if(Session::has('login_gagal'))
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('login_gagal') }}
        </div>
    @elseif(Session::has('login_info'))
        <div class="alert alert-warning alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('login_info') }}
        </div>
    @endif
    
    @csrf
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                <label for="txt_user" class="text-left float-left">Username / No Hp</label>
                <input type="text" id="txt_user" name="txt_user" class="form-control input-rounded" placeholder="Masukkan username / no hp" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="projectinput2" class="text-left float-left">Kata Sandi</label>
                <input type="password" id="txt_password" name="txt_password" class="form-control input-rounded" placeholder="Kata Sandi" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary px-3 py-1"><span class="" style="letter-spacing: 2px;">Masuk</span></button>
        </div>
    </div>

</form>
@endsection


@section('text-footer')
    <p class="text-center">
        <a href="/register" class="card-link">Daftar Akun</a> <a href="/forget-password" class="card-link">Lupa Kata Sandi</a> 
    </p>
@endsection  
