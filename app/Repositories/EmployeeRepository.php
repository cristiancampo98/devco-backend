<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{

    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getAll()
    {
        $query = $this->employee;
        if (request()->has('limit')) {
            $query = $this->employee->limit(request()->limit);
        }

        if (request()->has('equipment')) {
            if (request()->equipment === 'true') {
                $query = $this->employee::has('equipment');
            }
            if (request()->equipment === 'false') {
                $query = $this->employee::doesntHave('equipment');
            }
        }

        return $query->orderBy('id', 'DESC')->get();
    }

    public function store($data)
    {
        return $this->employee->create($data);
    }
}
