@extends('layouts.master')

@section('content')
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <h2>Selamat Datang {{Auth::user()->name}}</h2>
            <h4>Gunakan menu pada navbar untuk navigasi</h4>
        </div>
    </div>
</div>
@endsection