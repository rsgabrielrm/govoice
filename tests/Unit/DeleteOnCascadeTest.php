<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Number;
use App\Models\NumberPreference;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteOnCascadeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests cascading user deletion
     * @test
     */
    public function cascading_user_deletion()
    {

        $user = User::factory()
            ->has(Customer::factory()
                ->has(Number::factory()
                    ->has(NumberPreference::factory()
                        ->count(1)
                    )
                    ->count(4)
                )->count(2)
            )
         ->create();

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('customers', 2);
        $this->assertDatabaseCount('numbers', 8);
        $this->assertDatabaseCount('number_preferences', 8);

        $user->delete();

        $this->assertSoftDeleted($user);
        $this->assertSoftDeleted('customers');
        $this->assertSoftDeleted('numbers');
        $this->assertSoftDeleted('number_preferences');

    }
}
