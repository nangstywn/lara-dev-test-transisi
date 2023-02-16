<?php

namespace App\Repositories\Employee;

interface EmployeeRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $arr);
    public function update($id, array $arr);
    public function delete($id);
}
