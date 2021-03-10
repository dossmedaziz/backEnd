<?php

use Illuminate\Database\Seeder;
use App\models\PaperType ;

class PaperTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaperType::create([
            'paper_type'=> "Update"
            ]);
        PaperType::create([
                'paper_type'=> "Maintenance"
            ]);

        PaperType::create([
               'paper_type'=> "Hosting"
            ]);

        PaperType::create([
                'paper_type'=> "Purchase order"
            ]);
        PaperType::create([
                'paper_type'=> "Quote"
            ]);


    }
}
