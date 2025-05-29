@extends('auth.layout')

@section('title','Form Kata Sandi')

@section('title-auth')
    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
        <span>Form Lupa Kata Sandi</span>
    </h6>
@endsection 

@section('content')
<form class="form p-3 pb-0" style="margin-top: -20px" method="post" action="{{route('auth.action.forgot.password')}}">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="txt_sandi" class="text-left float-left">Kata Sandi</label>
                <input type="text" id="username" name="username" value="{{$username_value}}">
                <input type="text" id="txt_sandi" name="txt_sandi" class="form-control input-rounded" placeholder="Masukkan sandi anda" required>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                <label for="txt_sandi_ulangi" class="text-left float-left">Ulangi Kata Sandi</label>
                <input type="text" id="txt_sandi_ulangi" name="txt_sandi_ulangi" class="form-control input-rounded" placeholder="Masukkan ulangi sandi anda" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary px-3 py-1"><span class="" style="letter-spacing: 2px;">Proses</span></button>
        </div>
    </div>
</form>
@endsection


@section('text-footer')
    <p class="text-center">
        <a href="/" class="card-link">Sudah Punya Akun </a> <a href="/register" class="card-link">Daftar Akun</a> 
    </p>
@endsection  

