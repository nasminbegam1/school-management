<?php

use Illuminate\Database\Seeder;

use App\Usertype;
class UsertypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usertypes')->delete();
        
        $statement = "ALTER TABLE s_usertypes AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        DB::table('usertypes')->insert([
            ['type' => 'Super Admin','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Librarian','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Teacher','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'School Admin','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'School Staff','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Accountant','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Principal','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Laboratory Operator','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Receptionist','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Management','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Student','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type' => 'Guardians ','is_deleted' => 0,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]]
        );
    }
}
