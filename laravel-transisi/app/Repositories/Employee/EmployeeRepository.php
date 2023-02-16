<?php

namespace app\Repositories\Employee;

use App\Models\Companies;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Models\Employees;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    private $employee;
    private $company;
    public function __construct(Employees $employee, Companies $company)
    {
        $this->employee = $employee;
        $this->company = $company;
    }
    public function getAllCompanies()
    {
        return $this->company->all();
    }
    public function get()
    {
        return $this->employee->all();
    }

    public function getAll()
    {
        return $this->employee->orderBy('id', 'desc')->paginate(5);
    }
    public function getById($id)
    {
        return $this->employee->find($id);
    }
    public function create(array $arr)
    {
        return $this->employee->create($arr);
    }
    public function update($id, array $arr)
    {
        $emp = $this->employee->findOrFail($id);
        $emp->update($arr);
        return $emp;
    }
    public function delete($id)
    {
        $emp = $this->employee->findOrFail($id);
        $emp->delete();
        return $emp;
    }
}
