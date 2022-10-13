<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\District;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\School;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $faker = Factory::create();
        for ($i = 1; $i < 20; $i++) {
            $district_id = $faker->randomElement(District::get()->pluck('id')->toArray());
            $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
            $union_id = $faker->randomElement(Union::where('upazila_id',$upazila_id)->get()->pluck('id')->toArray());
            $school_id = $faker->randomElement(School::all()->pluck('id')->toArray());
            $batch_id = $faker->randomElement(Batch::all()->pluck('id')->toArray());
            $user_id = $faker->randomElement(User::get()->pluck('id')->toArray());
            $event_category_id = $faker->randomElement(EventCategory::get()->pluck('id')->toArray());
            $isprice = ['1','0','1','1','1','0'];

            $event= [
                'name' => $faker->sentence,
                'address' => $faker->address,
                'summary' => $faker->paragraph(3),
                'details' => $faker->paragraph(10),
                'is_free' => '1',
                'price' => null,
                'event_status' => '1',
                'event_date' => $faker->date('d-m-Y'),
                'event_time' => $faker->time,
                'district_id' => $district_id,
                'upazila_id' => $upazila_id,
                'union_id' => $union_id,
                'event_category_id' => $event_category_id,
                'created_by_id' => $user_id,

            ];
            $event = Event::create($event);
            $event->schools()->sync($school_id);
            $event->batches()->sync($batch_id);
            $this->eventUser($event);

        }

    }
    public function eventUser($event){
        $users = array();

        $faker = Factory::create();
        $j = $faker->randomNumber([20,40,15,63,50,32,90]);
        for ($i = 1; $i < $j; $i++) {
            $user_id = $faker->randomElement(User::get()->pluck('id')->toArray());
            array_push($users,$user_id);

        }
        $event->users()->sync($users);

    }
}
