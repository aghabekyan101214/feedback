<?php

use Illuminate\Database\Seeder;

class ActiveFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table("active_fields")->insert(
            array(
                array("field_name" => "name", "active" => 1, "required" => 1),
                array("field_name" => "email", "active" => 1, "required" => 0),
                array("field_name" => "phone", "active" => 1, "required" => 1),
                array("field_name" => "age", "active" => 1, "required" => 0),
                array("field_name" => "gender", "active" => 1, "required" => 0),
                array("field_name" => "table_number", "active" => 1, "required" => 0),
            )
        );
    }
}
