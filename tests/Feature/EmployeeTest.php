<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_employee_can_be_created()
    {
        $response = $this->postJson('/api/employee', [
            'email' => 'test@email.co',
            'name' => 'Test Feature'
        ]);

        $response
            ->assertJsonStructure([
                'status',
                'data' => [
                    'email',
                    'name',
                    'updated_at',
                    'created_at',
                    'id'
                ]
            ])
            ->assertStatus(200);
    }
    /**
     * @test
     */
    public function a_list_of_employees_can_be_retrieved()
    {

        Employee::create([
            'email' => 'test@email.co',
            'name' => 'Test Feature'
        ]);

        $response = $this->getJson('/api/employee');
        $response
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'email',
                        'name',
                        'updated_at',
                        'created_at',
                        'id'
                    ]
                ]
            ])
            ->assertStatus(200);
    }
}
