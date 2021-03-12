<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $only_user_tree = $this->command->askWithCompletion('Seeding....Only User tree(yes/no)', ['yes', 'no'], 'yes');

        if ($only_user_tree != 'yes') {
            $this->call(AdminUsersTableSeeder::class);
        }
    }
}
