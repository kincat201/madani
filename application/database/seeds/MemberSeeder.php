<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $datas = array();

        $types = [];
        foreach (\App\Util\Constant::MEMBER_TYPES_LIST as $type => $value){
            $types[] = $type;
        }

        for ($i = 0; $i < 50; $i++) {
            $data['name'] = $faker->name;
            $data['email'] = $faker->email;
            $data['phone'] = $faker->e164PhoneNumber;
            $data['address'] = $faker->address;
            $data['types'] = $types[mt_rand(0,count($types)-1)];
            $date = \Carbon\Carbon::now()->subDay(mt_rand(0,50));
            $data['created_at'] = $date;
            $data['updated_at'] = $date;
            array_push($datas, $data);
        }

        DB::table('members')->insert($datas);
    }
}
