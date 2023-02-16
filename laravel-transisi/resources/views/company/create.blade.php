@extends('layouts.master')

@section('content')
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Create Company</h2>
                </div>
                <form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="" class="form-control"
                                placeholder="Masukkan Nama Perusahaan" value="{{old('nama')}}">
                            @if ($errors->has('nama'))
                            <span class="text-danger">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control" placeholder="Masukkan Email"
                                value="{{old('email')}}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Website</label>
                            <input type="text" name="website" id="" class="form-control"
                                placeholder="Masukkan Alamat Website" value="{{old('website')}}">
                            @if ($errors->has('website'))
                            <span class=" text-danger">{{ $errors->first('website') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Upload Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if ($errors->has('logo'))
                            <span class="text-danger">{{ $errors->first('logo') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection