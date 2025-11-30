<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;


class StudentSeeder extends Seeder
{
    
    public function run(): void
    {
        // Sample students data
        $students = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@university.edu',
                'major' => 'Computer Science',
                'year' => 2
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@university.edu',
                'major' => 'Mathematics',
                'year' => 3
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob.johnson@university.edu',
                'major' => 'Physics',
                'year' => 1
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice.brown@university.edu',
                'major' => 'Chemistry',
                'year' => 4
            ],
            [
                'name' => 'Charlie Wilson',
                'email' => 'charlie.wilson@university.edu',
                'major' => 'Computer Science',
                'year' => 2
            ],
            [
                'name' => 'Diana Davis',
                'email' => 'diana.davis@university.edu',
                'major' => 'Biology',
                'year' => 3
            ],
            [
                'name' => 'Eva Martinez',
                'email' => 'eva.martinez@university.edu',
                'major' => 'Engineering',
                'year' => 1
            ],
            [
                'name' => 'Frank Garcia',
                'email' => 'frank.garcia@university.edu',
                'major' => 'Mathematics',
                'year' => 4
            ]
        ];

        // Create students in database
        foreach ($students as $studentData) {
            Student::create($studentData);
        }

        // Alternative method: Using Model::insert() for bulk insertion
        // Student::insert($students); // Note: This won't trigger model events or fill timestamps
        
        echo "✅ Created " . count($students) . " sample students\n";
    }
}
