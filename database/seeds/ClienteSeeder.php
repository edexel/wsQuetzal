<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert([
            'nombre' => 'Test',
            'apellido' => 'Tester',
            'email' => 'user2@mail.com',
            'password' => Hash::make('test123'),
            'descripcion' => Str::random(30),
            'activo' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
