<?php

namespace Teamtnt\SalesManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Teamtnt\SalesManagement\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'salutation' => $this->faker->title,
        ];
    }
}

