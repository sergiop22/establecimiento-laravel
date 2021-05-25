<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
        	'nombre' => 'Restaurante',
        	'slug' => Str::slug('Restaurante'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('categorias')->insert([
        	'nombre' => 'Café',
        	'slug' => Str::slug('Café'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('categorias')->insert([
        	'nombre' => 'Hotel',
        	'slug' => Str::slug('Hotel'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('categorias')->insert([
        	'nombre' => 'Bar',
        	'slug' => Str::slug('Bar'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('categorias')->insert([
        	'nombre' => 'Hospital',
        	'slug' => Str::slug('Hospital'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('categorias')->insert([
        	'nombre' => 'Gym',
        	'slug' => Str::slug('Gym'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('categorias')->insert([
        	'nombre' => 'Doctor',
        	'slug' => Str::slug('Doctor'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);
    }
}
