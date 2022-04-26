<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stringable;
use Illuminate\Support\Str;


class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meeting')->insert([
            'description' => Str::random(10),
            'company_id' => 5,
            'meeting_time' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
