@extends('layouts.master')

@section('content')
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Create Employees</h2>
                </div>
                <form action="{{route('employee.update', $employee->id)}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="" class="form-control" value="{{$employee->nama}}">
                            @if ($errors->has('nama'))
                            <span class="text-danger">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control" value="{{$employee->email}}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Company</label><br>
                            <select name="companies_id" id="companies_id" class="form-control select2">
                                @foreach($company as $com)
                                <option value="{{$com->id}}" {{$com->id == $employee->companies_id ? 'selected' : ''}}>
                                    {{$com->nama}}
                                </option>
                                @endforeach
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
    });
</script>
@endsection