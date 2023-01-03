<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::factory()->create();
        return
            [
                'first_name' => 'first1',
                'last_name' => 'last1',
                'email' => 'test@test12.com',
                'company_id' => $company->id,
                'phone' => 999999999
            ];
    }
}
