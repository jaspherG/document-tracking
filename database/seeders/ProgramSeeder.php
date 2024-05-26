<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [ 'program_name' => 'BSIT',
            'class_year' => json_encode(['First Year', 'Second Year', 'Third Year', 'Fourth Year']), 
            ],
            [ 'program_name' => 'BSED-MT',
            'class_year' => json_encode(['First Year', 'Second Year', 'Third Year', 'Fourth Year']), 
            ],
            [ 'program_name' => 'BSED-EN',
            'class_year' => json_encode(['First Year', 'Second Year', 'Third Year', 'Fourth Year']), 
            ],
            [ 'program_name' => 'BPA',
            'class_year' => json_encode(['First Year', 'Second Year', 'Third Year', 'Fourth Year']), 
            ],
        ];

        DB::table('programs')->insert($programs);
    }
}
