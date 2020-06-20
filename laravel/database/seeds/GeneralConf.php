<?php

use Illuminate\Database\Seeder;

class GeneralConf extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$demo=[
    		'slogan'=>'',
			'nosotros'=>'',
			'cotiza'=>'',
			'whatsapp'=>'',
			'telefono'=>'',
			'email'=>'',
			'instagram'=>'',
			'facebook'=>'',
			'twitter'=>''
    	];
    	foreach ($demo as $key => $value) {
    		
	        DB::table('general_configs')->insert([
	            'name' => $key,
	            'value' => $value,
	        ]);
    	}
    }
}
