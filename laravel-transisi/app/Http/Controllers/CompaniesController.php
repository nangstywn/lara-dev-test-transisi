<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Http\Requests\CompaniesRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    private $companyRepo;
    public function __construct(CompanyRepositoryInterface $com)
    {
        $this->companyRepo = $com;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = $this->companyRepo->getAll();
        return view('company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesRequest $request)
    {
        $file = $request->file('logo');
        $ext = $file->getClientOriginalExtension();
        $fileFoto = $request->nama . '.' . $ext;
        $destination = storage_path('app/company');
        $file->move($destination, $fileFoto);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $fileFoto
        ];
        $this->companyRepo->create($data);
        return redirect()->route('company.index')->with('success', 'Berhasil Menambah Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->companyRepo->getById($id);
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniesRequest $request, $id)
    {
        $com = $this->companyRepo->getById($id);
        if ($request->hasFile('logo')) {
            $image_path = storage_path('app/company/') . $com->logo;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $fileFoto = $request->name . '.' . $ext;
            $destination = storage_path('app/company');
            $file->move($destination, $fileFoto);
        } else {
            $fileFoto = $com->logo;
        }
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $fileFoto
        ];
        $this->companyRepo->update($id, $data);
        return redirect()->route('company.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->companyRepo->delete($id);
        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }
}
