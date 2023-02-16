@extends('layouts.master')

@section('content')
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Edit Employees</h2>
                </div>
                <form action="{{route('employee.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="" class="form-control" placeholder="Masukkan Nama" value="{{old('nama')}}">
                            @if ($errors->has('nama'))
                            <span class="text-danger">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control" placeholder="Masukkan Email" value="{{old('email')}}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Company</label><br>
                            <select name="companies_id" id="companies_id" class="form-control select2" value="{{old('companies_id')}}">
                                <option value="">Pilih Company</option>

                            </select>
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
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $.ajax({
            method: 'GET',
            url: '/getCompanies',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    $('#companies_id').append($('<option>', {
                        value: response[i].id,
                        text: response[i].nama
                    }));
                }
            }
        });
    });
</script>
@endsection