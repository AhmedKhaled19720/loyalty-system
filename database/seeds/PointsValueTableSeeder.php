<?php

use App\Point;
use Illuminate\Database\Seeder;

class PointsValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Point::insert([
            ['points_for_one' => 50, 'currency' => 'USD'],
            ['points_for_one' => 20, 'currency' => 'EGP'],
        ]);
    }
}
