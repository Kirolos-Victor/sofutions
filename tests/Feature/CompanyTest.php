<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    protected mixed $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        User::factory()->create();
        $this->user = User::first();
    }

    public function test_company_index_method()
    {
        $this->actingAs($this->user);
        $response = $this->get('/companies');
        $response->assertStatus(200);
    }

    public function test_company_create_method()
    {
        $this->actingAs($this->user);
        $response = $this->get('/companies/create');
        $response->assertStatus(200);
    }

    public function test_company_store_data()
    {
        $this->actingAs($this->user);
        $image = UploadedFile::fake()->image('avatar.jpg', 100, 100);
        $formData = [
            'name' => 'test2',
            'email' => 'test@test12.com',
            'logo' => $image,
            'website' => 'https://www.google.com/'
        ];
        $this->post('/companies', $formData);
        $this->assertDatabaseCount('companies', 1);
    }

    public function test_company_edit_method()
    {
        $this->actingAs($this->user);
        $company = Company::factory()->create();
        $response = $this->get('/companies/' . $company->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_company_update_method()
    {
        $this->actingAs($this->user);
        $formData = [
            'name' => 'test3',
            'email' => 'test@test3.com',
            'website' => 'https://www.google.com/'
        ];
        $company = Company::factory()->create();
        $this->put('/companies/' . $company->id, $formData);
        $this->assertDatabaseCount('companies', 1);
    }

    public function test_company_delete_method()
    {
        $this->actingAs($this->user);
        $company = Company::factory()->create();
        $this->delete('/companies/' . $company->id);
        $this->assertDatabaseCount('companies', 0);
    }
}
