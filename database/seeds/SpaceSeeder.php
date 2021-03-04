<?php

use Illuminate\Database\Seeder;
use App\models\Space ;
class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Space::create([
                'space_name'=>'Client',
        ]
        );
        Space::create([
            'space_name'=>'Project',
        ]
        );
        Space::create([
                'space_name'=>'User',
        ]
        );
        Space::create([
            'space_name'=>'Contract',
        ]
        );
        Space::create([
            'space_name'=>'Bills',
        ]
        );

    }
}
