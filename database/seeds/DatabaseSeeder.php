<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       DB::table('recheios')->insert(
			[
				['id' => 0, 'recheio' => 'GOIABADA'],
				['id' => 1, 'recheio' => 'M.MARACUJA'],
				['id' => 2, 'recheio' => 'M.MORANGO'],
				['id' => 3, 'recheio' => 'L.CONDESADO '],
				['id' => 5, 'recheio' => 'CHOCOLATE'],
				['id' => 6, 'recheio' => 'ABACAXI'],
				['id' => 7, 'recheio' => 'DOCE LEITE'],
				['id' => 8, 'recheio' => 'M.LIMAO'],

			]
		);
    }
}
