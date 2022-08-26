<?php

namespace App\Services;

use App\Repositories\EquipmentRepository;

class EquipmentService
{

    protected $equipmentRepository;

    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    public function findById($id)
    {
        return $this->equipmentRepository->findById($id);
    }

    public function getAllEquipments()
    {
        return $this->equipmentRepository->getAll();
    }

    public function store($data)
    {
        return $this->equipmentRepository->store($data);
    }

    public function update($id)
    {
        return $this->equipmentRepository->update($id);
    }
}
