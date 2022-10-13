<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\School;
use Carbon\Carbon;
use Faker\Factory;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $division_id = $faker->randomElement(Division::all()->pluck('id')->toArray());
        $district_id = $faker->randomElement(District::where('division_id',$division_id)->get()->pluck('id')->toArray());
        $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
        $union_id = $faker->randomElement(Union::where('upazila_id',$upazila_id)->get()->pluck('id')->toArray());
$name = $faker->company;
$slug =\Str::slug($name);

        for ($i = 1; $i < 20; $i++) {
            $school = [
                'name' => $name,
                'slug' => $slug,
                'email' => $faker->companyEmail,
                'contact_number' => $faker->phoneNumber,
                'about' => $faker->realText(200),
                'url' => $faker->url,
                'is_active' => '1',
                'is_approve' => '1',
                'division_id' => $division_id,
                'district_id' => $district_id,
                'upazila_id' => $upazila_id,
                'union_id' => $union_id,
            ];
            $school = School::create($school);
        }
    }
}
