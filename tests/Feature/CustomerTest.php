<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The visitor cannot see the list of customers.
     * @test
     * @return void
     */
    public function visitor_cannot_see_the_list_of_customers()
    {
        $response = $this->get(route('customers.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * The user can see the list of customers.
     * @test
     * @return void
     */
    public function user_can_see_the_list_of_customers()
    {
        $this->createUserAndAuthenticate();
        $response = $this->get(route('customers.index'));
        $response->assertStatus(200);
        $response->assertSeeText('There are no registered customers');
    }

    /**
     * The user can see the list of customers with records.
     * @test
     * @return void
     */
    public function user_can_see_the_list_of_customers_with_records()
    {
        $user = $this->createUserAndAuthenticate();

        Customer::factory()
            ->count(20)
            ->create([
                "user_id" => $user->id
            ]);

        $response = $this->get(route('customers.index'));
        $response->assertStatus(200);
        $response->assertDontSeeText('There are no registered customers');
    }

    /**
     * The user can create a client.
     * @test
     * @return void
     */
    public function user_can_create_a_client()
    {
        $this->createUserAndAuthenticate();

        $attributes = [
            "name" => "Customer test",
            "document" => "876546789812"
        ];

        $response = $this->post(route('customers.store', $attributes));

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', $attributes);
    }

    /**
     * the user cannot create a client with an invalid name and document.
     * @test
     * @return void
     */
    public function user_cannot_create_a_client_with_an_invalid_name_and_document()
    {
        $this->createUserAndAuthenticate();

        $attributes = [
            "name" => "",
            "document" => 876546789812123123
        ];

        $response = $this->postJson(route('customers.store', $attributes));

        $response->assertJsonValidationErrors([
            "name",
            "document",
        ]);

        $response->assertStatus(422);
    }

    /**
     * The user can see the customer edit page.
     * @test
     * @return void
     */
    public function user_can_see_the_customer_edit_page()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $response = $this->get(route('customers.edit', $customer->id));
        $response->assertStatus(200);
    }

    /**
     * The user cannot see another customer’s edit page.
     * @test
     * @return void
     */
    public function user_cannot_see_another_customers_edit_page()
    {
        $this->createUserAndAuthenticate();
        $userTwo = User::factory()->create();
        $customer = Customer::factory()->create([
            "user_id" => $userTwo->id,
        ]);

        $response = $this->get(route('customers.edit', $customer->id));
        $response->assertSessionHasErrors();
        $response->assertStatus(302);
    }

    /**
     * The user can edit a client.
     * @test
     * @return void
     */
    public function user_can_edit_a_client()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $attributes = [
            "name" => "test Customer",
            "document" => "432345234522",
            "status" => Customer::CUSTOMER_STATUS_OPTIONS[1],
        ];

        $response = $this->put(route('customers.update', $customer->id), $attributes);
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('customers', $attributes);
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
        $customer = Customer::factory()->create([
            "user_id" => $userTwo->id,
        ]);

        $attributes = [
            "name" => "test Customer",
            "document" => "432345234522",
            "status" => Customer::CUSTOMER_STATUS_OPTIONS[1],
        ];

        $response = $this->put(route('customers.update', $customer->id), $attributes);
        $response->assertSessionHasErrors();
        $response->assertStatus(302);
    }

    /**
     * The user cannot update a customer with an invalid name, document and status.
     * @test
     * @return void
     */
    public function user_cannot_update_a_customer_with_an_invalid_name_document_and_status()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $attributes = [
            "name" => "",
            "document" => "43",
            "status" => 'govoice',
        ];

        $response = $this->putJson(route('customers.update', $customer->id), $attributes);
        $response->assertJsonValidationErrors([
            "name",
            "document",
            "status"
        ]);
        $response->assertStatus(422);
    }

    /**
     * The user can delete a client
     * @test
     * @return void
     */
    public function user_can_delete_a_client()
    {
        $user = $this->createUserAndAuthenticate();
        $customer = Customer::factory()->create([
            "user_id" => $user->id,
        ]);

        $response = $this->delete(route('customers.destroy', $customer->id));

        $response->assertSessionDoesntHaveErrors();
        $response->assertSessionMissing('Client successfully deleted');
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
        $customer = Customer::factory()->create([
            "user_id" => $userTwo->id,
        ]);

        $response = $this->delete(route('customers.destroy', $customer->id));
        $response->assertSessionHasErrors();
        $response->assertSessionMissing('You are not allowed to delete the client!');
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
