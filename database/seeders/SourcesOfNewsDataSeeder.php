<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class SourcesOfNewsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sources_of_news_data')->insert($this->getData());
    }

    private function getData(): array
    {
        $faker = Factory::create();
        $data = [];

        for($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $faker->sentence(mt_rand(3,10)),
                'url' => $faker->url()
            ];
        }
        return $data;
    }
}
