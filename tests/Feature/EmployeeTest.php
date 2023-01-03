<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected mixed $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        User::factory()->create();
        $this->user = User::first();
    }

    public function test_employee_index_method()
    {
        $this->actingAs($this->user);
        $response = $this->get('/employees');
        $response->assertStatus(200);
    }

    public function test_employee_create_method()
    {
        $this->actingAs($this->user);
        $response = $this->get('/employees/create');
        $response->assertStatus(200);
    }

    public function test_employee_store_data()
    {
        $this->actingAs($this->user);
        $company = Company::factory()->create();
        $formData = [
            'first_name' => 'first2',
            'last_name' => 'last2',
            'email' => 'test@test12.com',
            'company_id' => $company->id,
            'phone' => 999999999
        ];
        $this->post('/employees', $formData);
        $this->assertDatabaseCount('employees', 1);
    }

    public function test_employee_edit_method()
    {
        $this->actingAs($this->user);
        $employee = Employee::factory()->create();
        $response = $this->get('/employees/' . $employee->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_employee_update_method()
    {
        $this->actingAs($this->user);
        $formData = [
            'first_name' => 'first3',
            'last_name' => 'last3',
            'email' => 'test@test12.com',
            'phone' => 999999999
        ];
        $employee = Employee::factory()->create();
        $this->put('/employees/' . $employee->id, $formData);
        $this->assertDatabaseCount('employees', 1);
    }

    public function test_employee_delete_method()
    {
        $this->actingAs($this->user);
        $employee = Employee::factory()->create();
        $this->delete('/employees/' . $employee->id);
        $this->assertDatabaseCount('employees', 0);
    }
}