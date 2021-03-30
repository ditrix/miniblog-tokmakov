<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run() {
        // создать 4 пользователей сайта
        factory(App\User::class, 4)->create();
    }
}
