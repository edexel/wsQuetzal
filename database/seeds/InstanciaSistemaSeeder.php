<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InstanciaSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instancia_sistema')->insert([
            'idCliente' => 1,
            'nombre' => 'Cliente',
            'descripcion' => Str::random(30),
            'subDominio' => Str::random(10),
            'activo' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
