<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Number;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NumberTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The visitor cannot see the list of numbers.
     * @test
     * @return void
     */
    public function visitor_cannot_see_the_list_of_numbers()
    {
        $response = $this->get(route('numbers.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * The user can see the list of numbers.
     * @test
     * @return void
     */
    public function user_can_see_the_list_of_numbers()
    {
        $this->createUserAndAuthenticate();
        $response = $this->get(route('numbers.index'));
        $response->assertStatus(200);
        $response->assertSeeText('There are no registered numbers');
    }

    /**
     * The user can see the list of numbers with records.
     * @test
     * @return void
     */
    public function user_can_see_the_list_of_customers_with_records()
    {
        $user = $this->createUserAndAuthenticate();

        Customer::factory()
            ->has(Number::factory()->count(3))
            ->create([
                "user_id" => $user->id
            ]);

        Customer::factory()
            ->has(Number::factory()->count(2))
            ->create([
                "user_id" => $user->id
            ]);

        $response = $this->get(route('numbers.index'));
        $response->assertStatus(200);
        $response->assertDontSeeText('There are no registered customers');
    }

    /**
     * The user can create a number.
     * @test
     * @return void
     */
    public function user_can_create_a_number()
    {
        $user = $this->createUserAndAuthenticate();

        $customer = Customer::factory()
            ->create([
                "user_id" => $user->id
            ]);

        $attributes = [
            "customer_id" => $customer->id,
            "number" => "+11458 752 141"
        ];

        $response = $this->post(route('numbers.store', $attributes));

        $response->assertRedirect(route('numbers.index'));
        $this->assertDatabaseHas('numbers', [
            "customer_id" => $customer->id,
            "number" => "11458752141"
        ]);
    }

    /**
     * the user cannot create a number with an invalid number.
     * @test
     * @return void
     */
    public function user_cannot_create_a_number_with_an_invalid_number()
    {
        $user = $this->createUserAndAuthenticate();

        $customer = Customer::factory()
            ->create([
                "user_id" => $user->id
            ]);

        $attributes = [
            "customer_id" => $customer->id,
            "number" => "+1    789"
        ];

        $response = $this->postJson(route('numbers.store', $attributes));

        $response->assertJsonValidationErrors([
            "number",
        ]);

        $response->assertStatus(422);
    }

    /**
     * The user can see the number edit page.
     * @test
     * @return void
     */
    public function user_can_see_the_number_edit_page()
    {
        $user = $this->createUserAndAuthenticate();

        $customer = Customer::factory()
            ->create([
                "user_id" => $user->id
            ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $response = $this->get(route('numbers.edit', $number->id));
        $response->assertStatus(200);
    }

    /**
     * The user cannot see another numbers edit page.
     * @test
     * @return void
     */
    public function user_cannot_see_another_numbers_edit_page()
    {
        $this->createUserAndAuthenticate();
        $userTwo = User::factory()->create();
        $customer = Customer::factory()
            ->create([
            "user_id" => $userTwo->id,
        ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $response = $this->get(route('numbers.edit', $number->id));
        $response->assertSessionHasErrors();
        $response->assertStatus(302);
    }

    /**
     * The user can edit a number.
     * @test
     * @return void
     */
    public function user_can_edit_a_number()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $attributes = [
            "customer_id" => $customer->id,
            "number" => "+11 45 g 8 752 141",
            "status" => Number::NUMBER_STATUS_OPTIONS[1]
        ];

        $response = $this->put(route('numbers.update', $number->id), $attributes);
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('numbers', [
            "customer_id" => $customer->id,
            "number" => "11458752141",
            "status" => Number::NUMBER_STATUS_OPTIONS[1]
        ]);
    }

    /**
     * The user cannot update another user's client.
     * @test
     * @return void
     */
    public function user_cannot_update_another_users_client()
    {
        $this->createUserAndAuthenticate();

        $userTwo = User::factory()->create();
        $customer = Customer::factory()
            ->create([
                "user_id" => $userTwo->id,
            ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $attributes = [
            "name" => "test Customer",
            "document" => "432345234522",
            "status" => Customer::CUSTOMER_STATUS_OPTIONS[1],
        ];

        $response = $this->put(route('numbers.update', $number->id), $attributes);
        $response->assertSessionHasErrors();
        $response->assertSessionMissing('You are not allowed to edit the number!');
        $response->assertStatus(302);
    }

    /**
     * The user cannot update a number with an invalid number and status.
     * @test
     * @return void
     */
    public function user_cannot_update_a_number_with_an_invalid_number_and_status()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $attributes = [
            "customer_id" => $customer->id,
            "number" => "+11 test 1",
            "status" => ''
        ];

        $response = $this->putJson(route('numbers.update', $number->id), $attributes);
        $response->assertJsonValidationErrors([
            "number",
            "status"
        ]);
        $response->assertStatus(422);
    }

    /**
     * The user can delete a number
     * @test
     * @return void
     */
    public function user_can_delete_a_number()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $response = $this->delete(route('numbers.destroy', $number->id));

        $response->assertSessionDoesntHaveErrors();
        $response->assertSessionMissing('Number successfully deleted');
    }

    /**
     * The user cannot delete another user's client.
     * @test
     * @return void
     */
    public function user_cannot_delete_another_users_client()
    {
        $this->createUserAndAuthenticate();

        $userTwo = User::factory()->create();
        $customer = Customer::factory()
            ->create([
                "user_id" => $userTwo->id,
            ]);

        $number = Number::factory()->create([
            'customer_id' => $customer->id
        ]);

        $response = $this->delete(route('numbers.destroy', $number->id));
        $response->assertSessionHasErrors();
        $response->assertSessionMissing('You are not allowed to delete the number!');
        $response->assertStatus(302);
    }

    /**
     * Auxiliary function to create user and authenticate him
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function createUserAndAuthenticate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }
}
