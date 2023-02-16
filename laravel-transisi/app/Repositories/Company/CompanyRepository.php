<?php

namespace app\Repositories\Company;

use App\Repositories\Company\CompanyRepositoryInterface;
use App\Models\Companies;


class CompanyRepository implements CompanyRepositoryInterface
{
    private $company;
    public function __construct(Companies $company)
    {
        $this->company = $company;
    }
    public function getAll()
    {
        return $this->company->orderBy('id', 'desc')->paginate(5);
    }
    public function getById($id)
    {
        return $this->company->find($id);
    }
    public function create(array $arr)
    {
        return $this->company->create($arr);
    }
    public function update($id, array $arr)
    {
        $com = $this->company->findOrFail($id);
        $com->update($arr);
        return $com;
    }
    public function delete($id)
    {
        $com = $this->company->findOrFail($id);
        $com->delete();
        return $com;
    }
}
