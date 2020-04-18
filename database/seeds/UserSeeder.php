<?php

use Illuminate\Database\Seeder;
use App\Domain\Users\Models\User;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id'         => (string) Uuid::uuid4(),
            'first_name' => "Jakub",
            "last_name"  => "Grajnert",
            'email'      => 'admin@ledsystem.com',
            'password'   => password_hash('ledsystem!@', PASSWORD_BCRYPT),
        ]);
    }
}
