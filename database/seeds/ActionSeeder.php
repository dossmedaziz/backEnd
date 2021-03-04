<?php

use Illuminate\Database\Seeder;
use App\models\Action ; 
class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::create(
           [
                'action_name'=>'Create'
            ]
        );
        Action::create(
            [
                 'action_name'=>'Read'
             ]
         );
         Action::create(
            [
                 'action_name'=>'Update'
             ]
         );
         Action::create(
            [
                 'action_name'=>'Delete'
             ]
         );
    }
}
