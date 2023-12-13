<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'size' => 'Small',                
                'count' => 0
            ],
            [
              'size' => 'Medium',              
              'count' => 20,                                
            ],
              [
              'size' => 'Large',              
              'count' => 40,                                
              ]
        );
        foreach ($data as $d) {
            Size::create([
                'size' => $d['size'],
                'count' => $d['count']                
            ]);
        }
    }
}
