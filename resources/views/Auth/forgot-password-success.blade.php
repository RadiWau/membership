@extends('auth.layout')

@section('title','Kata Sandi Berhasil Dirubah')

@section('content')
    <div class="alert alert-success alert-dismissable fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        Kata Sandi Berhasil Dirubah
    </div>

    <br/>

    <div class="row">
        <div class="col-12 text-center">
            <button type="button" onclick="location.href='/'" class="btn btn-primary px-3 py-1"><span class="" style="letter-spacing: 2px;">Masuk</span></button>
        </div>
    </div>
    <br/>
    <br/>
@endsection


