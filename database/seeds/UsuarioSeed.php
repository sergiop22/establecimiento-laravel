<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Sergio',
        	'email' => 'sergio@sergio.com',
        	'email_verified_at' => Carbon::now(),
        	'password' => Hash::make('sergiosx12330'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()

        ]);

        DB::table('users')->insert([
        	'name' => 'Alex',
        	'email' => 'alex@alex.com',
        	'email_verified_at' => Carbon::now(),
        	'password' => Hash::make('sergiosx12330'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}
