<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->delete();
        
        $statement = "ALTER TABLE s_modules AUTO_INCREMENT = 1;";
        DB::unprepared($statement);
        
        DB::table('modules')->insert([
            'module_name' => 'User Module',
            'is_active' => 1,
            'is_deleted' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
