<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Http\Requests\EmployeesRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    private $employeeRepo;
    public function __construct(EmployeeRepositoryInterface $employ)
    {
        $this->employeeRepo = $employ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = $this->employeeRepo->getAll();
        return view('employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {
        $data = [
            'nama' => $request->nama,
            'companies_id' => $request->companies_id,
            'email' => $request->email
        ];
        $this->employeeRepo->create($data);
        return redirect()->route('employee.index')->with('success', 'Berhasil Menambah Employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employeeRepo->getById($id);
        $company = $this->employeeRepo->getAllCompanies();
        return view('employee.edit', compact('employee', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesRequest $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'companies_id' => $request->companies_id
        ];
        $this->employeeRepo->update($id, $data);
        return redirect()->route('employee.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->employeeRepo->delete($id);
        return response()->json(['success' => 'Berhasil Menghapus Data']);
    }
    public function getCompanies()
    {
        $company = $this->employeeRepo->getAllCompanies();
        return response()->json($company);
    }

    public function exportPdf()
    {
        $datas = $this->employeeRepo->get();
        $pdf = Pdf::loadView('employee.pdf', array('employee' => $datas))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('employees.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
    public function importExcel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $path = storage_path('app/import');
        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move($path, $nama_file);

        // import data
        Excel::import(new EmployeesImport, public_path('storage/import/' . $nama_file));

        // alihkan halaman kembali
        return redirect()->route('employee.index')->with('Data Employee Berhasil Diimport');
    }
}
