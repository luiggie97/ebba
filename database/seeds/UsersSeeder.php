<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@email.com";
        $user->password = bcrypt("string123");
        $user->cpf = "345.146.000-91";
        $user->admin = true;
        $user->save();

        $user = new User();
        $user->name = "José";
        $user->email = "jose@email.com";
        $user->password = bcrypt("string123");
        $user->cpf = "744.714.500-93";
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = "João";
        $user->email = "joao@email.com";
        $user->password = bcrypt("string123");
        $user->cpf = "085.302.750-12";
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = "Maria";
        $user->email = "maria@email.com";
        $user->password = bcrypt("string123");
        $user->cpf = "323.233.050-93";
        $user->admin = false;
        $user->save();
    }}
