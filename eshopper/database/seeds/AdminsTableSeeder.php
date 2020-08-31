<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('admins')->delete();
        $adminRecords = [
        	['id'=>1, 'name'=>'admin', 'type'=>'admin', 'mobile'=>'+989189278691',
        	 'email'=>'admin@admin.com', 'password'=>'$2y$10$grP2.H1nIatoyw3wfL90e.BJOw88byg9ZSoZrHmPEguyK.oPgZgNq', 'image'=>'', 'status'=>1,
        	],
        ];
	DB::table('admins')->insert($adminRecords);
        
    }
}
