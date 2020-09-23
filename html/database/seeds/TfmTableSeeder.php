<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TfmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin app',
            'email' => 'admin@lumen.com',
            'password' => app('hash')->make('admin'),
            'admin' => true,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('users')->insert([
            'name' => 'User Adolfo',
            'email' => 'usera@lumen.com',
            'password' => app('hash')->make('12345'),
            'admin' => false,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('users')->insert([
            'name' => 'User Bernardo',
            'email' => 'userb@lumen.com',
            'password' => app('hash')->make('qwerty'),
            'admin' => false,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        // Articulos
        DB::table('articulos')->insert([
            'user_id' => 2,
            'nombre' => 'Chupeta Mix azul',
            'valor' => 15.35,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('articulos')->insert([
            'user_id' => 2,
            'nombre' => 'Turron Ambrosia',
            'valor' => 15.80,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('articulos')->insert([
            'user_id' => 2,
            'nombre' => 'Colombina Samsara',
            'valor' => 25,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('articulos')->insert([
            'user_id' => 3,
            'nombre' => 'Pan Mariquiteño',
            'valor' => 20,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('articulos')->insert([
            'user_id' => 3,
            'nombre' => 'Sueño veleño',
            'valor' => 12,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}