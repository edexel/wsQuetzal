<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstanciaCodigosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instancia_codigos')->insert([
            'idInstanciaSistema' => 1,
            'codigo' => 'codigo123456',
            'activo' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
