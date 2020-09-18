<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'pony@prancing.com',
            'password' => Hash::make('letmeinplease'),
        ]);
//
//        DB::table('reservations')->insert([
//            'email' => 'mail@test.com',
//            'first_name' => 'andy',
//            'last_name' => 'guiza',
//            'phone' => '6861000000',
//            'check_in' => '2020-10-01',
//            'check_out' => '2020-10-15',
//            'bed_qty' => 3,
//        ]);

        Room::factory()
            ->count(20)
            ->state (new Sequence(
                ['room_num' => 101],
                ['room_num' => 102],
                ['room_num' => 103],
                ['room_num' => 104],
                ['room_num' => 105],
                ['room_num' => 106],
                ['room_num' => 107],
                ['room_num' => 108],
                ['room_num' => 109],
                ['room_num' => 110],
                ['room_num' => 201, 'bed_qty' => 2, 'name' => 'double room', 'price' => 200.00],
                ['room_num' => 202, 'bed_qty' => 2, 'name' => 'double room', 'price' => 200.00],
                ['room_num' => 203, 'bed_qty' => 2, 'name' => 'double room', 'price' => 200.00],
                ['room_num' => 204, 'bed_qty' => 2, 'name' => 'double room', 'price' => 200.00],
                ['room_num' => 205, 'bed_qty' => 2, 'name' => 'double room', 'price' => 200.00],
                ['room_num' => 301, 'bed_qty' => 4, 'name' => 'four bed suite', 'price' => 400.00],
                ['room_num' => 302, 'bed_qty' => 4, 'name' => 'four bed suite', 'price' => 400.00],
                ['room_num' => 303, 'bed_qty' => 4, 'name' => 'four bed suite', 'price' => 400.00],
                ['room_num' => 401, 'bed_qty' => 5, 'name' => 'master suite', 'price' => 1000.00],
                ['room_num' => 501, 'bed_qty' => 6, 'name' => 'presidential suite', 'price' => 2000.00],
            ))
            ->create();

//
//        DB::table('room_reservations')->insert([
//            'room_id' => 1,
//            'reservation_id' => 1,
//        ]);
//
//        DB::table('room_reservations')->insert([
//            'room_id' => 11,
//            'reservation_id' => 1,
//        ]);
    }
}
