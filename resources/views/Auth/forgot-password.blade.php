@extends('auth.layout')

@section('title','Lupa Kata Sandi')

@section('title-auth')
    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
        <span>Lupa Kata Sandi</span>
    </h6>
@endsection 

@section('content')
<form class="form p-3 pb-0" style="margin-top: -20px" method="post" action="{{route('auth.action.form.cek.member')}}">
    @if(Session::has('cek_success'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('cek_success') }}
        </div>
    @elseif(Session::has('cek_failed'))
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('cek_failed') }}
        </div>
    @endif
    
    @csrf
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                <label for="txt_username" class="text-left float-left">Username</label>
                <input type="text" id="txt_username" name="txt_username" class="form-control input-rounded" placeholder="Masukkan username anda" value="{{ old('txt_username') }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary px-3 py-1"><span class="" style="letter-spacing: 2px;">Kirim</span></button>
        </div>
    </div>
</form>
@endsection


@section('text-footer')
    <p class="text-center">
        <a href="/" class="card-link">Sudah Punya Akun </a> <a href="/register" class="card-link">Daftar Akun</a> 
    </p>
@endsection  

