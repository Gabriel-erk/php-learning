<?php

namespace Database\Seeders;

use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReserveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 0; $i < 10; $i++) {
        //     Reserve::create([
        //         'user_id' => rand(0, 10),
        //         'room_id' => rand(0, 10),
        //         'reserve_date' => Carbon::tomorrow(),
        //         // inicia sempre amanhã
        //         'start_time' => Carbon::tomorrow(),
        //         // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
        //         'end_time' => Carbon::tomorrow()->addDays(1),
        //         'observation' => 'Reserve 4 two.'
        //     ]);
        // }
        Reserve::create([
            'user_id' => 1,
            'room_id' => 1,
            'reserve_date' => Carbon::tomorrow(),
            // inicia sempre amanhã
            'start_time' => Carbon::tomorrow(),
            // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
            'end_time' => Carbon::tomorrow()->addDays(1),
            'observation' => 'Reserve 4 two.'
        ]);

        Reserve::create([
            'user_id' => 2,
            'room_id' => 2,
            'reserve_date' => Carbon::tomorrow(),
            // inicia sempre amanhã
            'start_time' => Carbon::tomorrow(),
            // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
            'end_time' => Carbon::tomorrow()->addDays(1),
            'observation' => 'Reserve 4 two.'
        ]);

        Reserve::create([
            'user_id' => 2,
            'room_id' => 2,
            'reserve_date' => Carbon::tomorrow(),
            // inicia sempre amanhã
            'start_time' => Carbon::tomorrow(),
            // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
            'end_time' => Carbon::tomorrow()->addDays(1),
            'observation' => 'Reserve 4 two.'
        ]);

        Reserve::create([
            'user_id' => 3,
            'room_id' => 3,
            'reserve_date' => Carbon::tomorrow(),
            // inicia sempre amanhã
            'start_time' => Carbon::tomorrow(),
            // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
            'end_time' => Carbon::tomorrow()->addDays(1),
            'observation' => 'Reserve 4 two.'
        ]);

        Reserve::create([
            'user_id' => 4,
            'room_id' => 4,
            'reserve_date' => Carbon::tomorrow(),
            // inicia sempre amanhã
            'start_time' => Carbon::tomorrow(),
            // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
            'end_time' => Carbon::tomorrow()->addDays(1),
            'observation' => 'Reserve 4 two.'
        ]);

        Reserve::create([
            'user_id' => 5,
            'room_id' => 5,
            'reserve_date' => Carbon::tomorrow(),
            // inicia sempre amanhã
            'start_time' => Carbon::tomorrow(),
            // pega o dia de amanhã e adiciona mais um dia, ou seja, termina depois de amanhã
            'end_time' => Carbon::tomorrow()->addDays(1),
            'observation' => 'Reserve 4 two.'
        ]);
    }
}
