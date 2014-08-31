<?php
class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->insert(
 
            array(
                array(
                    'id' => 1,
                    'username' => 'Admin',
                    'password' => Hash::make('admin'),
                    'email' => 'admin@plop.fr',
                    'userStatut' => 'admin',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'id' => 2,
                    'username' => 'Paul',
                    'password' => Hash::make('paul'),
                    'email' => 'paul@plop.fr',
                    'userStatut' => 'admin',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
                array(
                    'id' => 3,
                    'username' => 'Jean',
                    'password' => Hash::make('jean'),
                    'email' => 'jean@plop.fr',
                    'userStatut' => 'user',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                ),
            )
        );
    }
}