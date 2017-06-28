<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Employee::truncate();

        factory(App\Employee::class, 1)->create([
            'position' => 'Boss',
            'boss_id' => 0
        ]);

        factory(App\Employee::class, 5)->create([
           'position' => 'Level 1',
            'boss_id' => 1
        ])->each(function ($e) {
            factory(App\Employee::class, 7)->create([
                'boss_id' => function() use ($e) {
                    return $e->id;
                },
                'position' => 'Level 2'
            ])->each(function ($e) {
                factory(App\Employee::class, 10)->create([
                    'boss_id' => function() use ($e) {
                        return $e->id;
                    },
                    'position' => 'Level 3'
                ])->each(function($e) {
                    factory(App\Employee::class, 12)->create([
                        'boss_id' => function() use ($e) {
                            return $e->id;
                        },
                        'position' => 'Level 4'
                    ])->each(function($e) {
                        factory(App\Employee::class, 15)->create([
                            'boss_id' => function() use ($e) {
                                return $e->id;
                            },
                            'position' => 'Level 5'
                        ]);
                    });
                });
            });
    });
    }
}
