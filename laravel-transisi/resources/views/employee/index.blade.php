@extends('layouts.master')

@section('content')
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <div class="col-md-8 d-flex flex-row align-items-center justify-content-around">
                        <h2 class="card-title">List Employee</h2>
                        <div class="btn btn-group">
                            <a href="{{url('export/pdf')}}" class="btn btn-success" target="_blank"><i
                                    class="fa fa-file-excel-o"></i> Export to PDF</a>

                            <a href="{{url('export/excel')}}" class="btn btn-primary" target="_blank">Export to
                                Excel</a>
                            <a href="{{url('import/excel')}}" class="btn btn-danger" data-toggle="modal"
                                data-target="#exampleModal">Import
                                Excel</a>
                        </div>
                    </div>
                    <div class="add text-right w-25">
                        <a href="{{route('employee.create')}}" class="btn btn-primary">Add Employee</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success"><span class="fa fa-check-circle"></span>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($employee as $data)
                            <tr>
                                <td>{{$employee->perPage()*($employee->currentPage()-1)+$i++}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->company->nama}}</td>
                                <td>
                                    <a href="{{route('employee.edit', $data->id)}}" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i>Edit</a>
                                    <a href="" class="btn btn-sm btn-danger delete" data-id="{{$data->id}}"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{ $employee->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('import/excel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Upload File Excel</label>
                        <input type="file" name="file" class="form-control"
                            accept=accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$('.delete').click(function(e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    Swal.fire({
        title: 'Yakin ?',
        text: "Ingin menghapus data ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28A745',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidaaak!!',
        confirmButtonText: 'Ya, hapus aja!!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '{{ Url("employee")}}' + '/' + id,
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name=csrf-token]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(location.reload(), 4000)
                }
            });
        }
    })
});
</script>
@endsection