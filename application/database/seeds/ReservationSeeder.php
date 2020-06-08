<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $reservations = array();
        $status = [\App\Util\Constant::RESERVATION_STATUS_NEW, \App\Util\Constant::RESERVATION_STATUS_APPROVED, \App\Util\Constant::RESERVATION_STATUS_REJECTED];
        $food = [\App\Util\Constant::FOOD_YES,\App\Util\Constant::FOOD_NO];
        $room = [\App\Util\Constant::ROOM_BIG, \App\Util\Constant::ROOM_SMALL];

        for ($i=2; $i <= 51; $i++) {
            $data['userId'] = $i;
            $data['title'] = $faker->sentence;
            $data['room'] = $room[mt_rand(0,1)];
            $data['pic'] = $faker->name;
            $data['amount'] = mt_rand(2,20);
            $data['food'] = $food[mt_rand(0,1)];
            $data['reservationDate'] = $faker->date('Y-m-d');
            $data['reservationTimeFrom'] = $faker->time();
            $data['reservationTimeTo'] = $faker->time();
            $data['remark'] = $faker->sentence;
            $data['status'] = $status[mt_rand(0,2)];
            $data['created_at'] = $faker->dateTime();
            $data['updated_at'] = $faker->dateTime();
            array_push($reservations, $data);
        }

        DB::table('reservation')->insert($reservations);
    }
}
