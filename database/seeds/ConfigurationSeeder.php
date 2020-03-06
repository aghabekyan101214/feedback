<?php

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table("configurations")->insert(
            array(
                array("is_admin" => 0, "update_time" => 0),
            )
        );
    }
}
