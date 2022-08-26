<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_equipment_can_be_created()
    {
        $response = $this->postJson('/api/equipment', [
            'name' => 'ASUS',
            'so' => 'WINDOWS',
            'type' => 'laptop',
        ]);
        $response
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'type',
                    'so',
                    'created_at',
                    'updated_at',
                ]
            ])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_equipment_can_be_retrieved()
    {
        $equipment = Equipment::create([
            'name' => 'ASUS',
            'so' => 'WINDOWS',
            'type' => 'laptop',
        ]);
        $response = $this->getJson('/api/equipment/' . $equipment->id);
        $response
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'type',
                    'so',
                    'employee_id',
                    'created_at',
                    'updated_at',
                ]
            ])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_equipment_can_be_update()
    {
        $employee = Employee::create([
            'email' => 'test@email.co',
            'name' => 'Test Feature'
        ]);

        $equipment = Equipment::create([
            'name' => 'ASUS',
            'so' => 'WINDOWS',
            'type' => 'laptop',
        ]);

        $response = $this->putJson('/api/equipment/' . $equipment->id, [
            'employee_id' => $employee->id,
            'name' => 'ACER'
        ]);

        $response->assertExactJson([
            'status' => 200,
            'data' => 1,
        ])->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_list_of_equipments_can_be_retrieved()
    {
        Equipment::create([
            'name' => 'ASUS',
            'so' => 'WINDOWS',
            'type' => 'laptop',
        ]);

        $response = $this->getJson('/api/equipment');
        $response
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'type',
                        'so',
                        'created_at',
                        'updated_at',
                        'employee_id',
                    ]
                ]
            ])
            ->assertStatus(200);
    }
}
