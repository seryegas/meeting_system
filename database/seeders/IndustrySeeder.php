<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::create(['industry_name' => 'Ретейл']);
        Industry::create(['industry_name' => 'Оптовые продажи и дистрибуция']);
        Industry::create(['industry_name' => 'Фармацевтика и здоровье']);
        Industry::create(['industry_name' => 'Аудит и консалтинг']);
        Industry::create(['industry_name' => 'Транспорт и логистика']);
        Industry::create(['industry_name' => 'Инвестиции и финансы']);
        Industry::create(['industry_name' => 'Производство, добыча, сырье']);
        Industry::create(['industry_name' => 'Строительство']);
        Industry::create(['industry_name' => 'Образование и учреждения']);
        Industry::create(['industry_name' => 'Другое']);
    }
}
