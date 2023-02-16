<style>
table,
th,
td {
    border-collapse: collapse;
    border: 1px solid black;
    width: 100%;
    text-align: left;
}
</style>
<div class="container bg-red">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h2 class="card-title w-25">List Employee</h2>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success"><span class="fa fa-check-circle"></span>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <table class="table" border="1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i= 1; @endphp
                            @foreach($employee as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->company->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>