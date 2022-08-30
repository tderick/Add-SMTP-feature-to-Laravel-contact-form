<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Parameters;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user =  new User();

        $user->email = "test@example.com";
        $user->name = "John Doea";
        $user->password = bcrypt("password");
        $user->save();

        $parameters = new Parameters();
        $parameters->is_email_notification_actived = 1;
        $parameters->save();
    }
}
