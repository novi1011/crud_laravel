<?php

use Illuminate\Database\Seeder;

class IsiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $form=[
            [
                'title'=>'smt spi',
                'desc'=>'1234',
            ],
            [
                'title'=>'smt stamp',
                'desc'=>'5678',
            ],
            [
                'title'=>'smt loader',
                'desc'=>'91011'
            ],
        ]; 
        DB::table('forms')->insert($form);
    }
}
