<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{

    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAll();
    }

    public function store($data)
    {
        return $this->employeeRepository->store($data);
    }
}
