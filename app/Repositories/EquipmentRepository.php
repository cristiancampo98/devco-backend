<?php

namespace App\Repositories;

use App\Models\Equipment;

class EquipmentRepository
{

    protected $equipment;

    public function __construct(Equipment $equipment)
    {
        $this->equipment = $equipment;
    }

    public function getAll()
    {
        return $this->equipment->all();
    }

    public function store($data)
    {
        return $this->equipment->create($data);
    }

    public function update($id)
    {
        return $this->equipment->where('id', $id)
            ->update(request()->all());
    }

    public function findById($id)
    {
        return $this->equipment->find($id);
    }
}
