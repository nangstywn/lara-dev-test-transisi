@extends('layouts.master')

@section('content')
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h2 class="card-title w-25">List Company</h2>
                    <div class="add text-right w-25">
                        <a href="{{route('company.create')}}" class="btn btn-primary">Add Company</a>
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
                                <th>Website</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i= 1; @endphp
                            @foreach($company as $data)
                            <tr>
                                <td>{{$company->perPage()*($company->currentPage()-1)+$i++}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->website}}</td>
                                <td>
                                    <img src="{{asset('storage/company/'.$data->logo)}}" width="50" alt="">
                                </td>
                                <td>
                                    <a href="{{route('company.edit', $data->id)}}" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i>Edit</a>
                                    <a href="" class="btn btn-sm btn-danger delete" data-id="{{$data->id}}"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <div class="div">
                        {{ $company->links() }}
                    </div>
                </div>
            </div>
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
                url: '{{ Url("company")}}' + '/' + id,
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