<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected mixed $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        User::factory()->create();
        $this->user = User::first();
    }

    public function test_the_dashboard_returns_a_successful_response()
    {
        $this->actingAs($this->user);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}