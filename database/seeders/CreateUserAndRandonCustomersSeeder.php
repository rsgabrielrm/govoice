<?php

namespace Database\Seeders;


use App\Models\Customer;
use App\Models\Number;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserAndRandonCustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::factory()->create(
            [
                "name" => "GoVoice",
                "email" => "test@govoice.com",
                "password" => Hash::make('govoice2021')
            ]
        );

        $customers = Customer::factory()
                            ->count(10)
                            ->create([
                                "user_id" => $user->id,
                            ]);

        foreach ($customers as $customer) {
                Number::factory()
                        ->count(rand(1,10))
                        ->create([
                            "customer_id" => $customer->id,
                        ]);
        }

    }
}
