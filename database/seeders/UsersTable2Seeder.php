<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Batch;
use App\Models\Designation;
use App\Models\District;
use App\Models\Division;
use App\Models\FieldOfWork;
use App\Models\Organization;
use App\Models\School;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Symfony\Component\Translation\t;

class UsersTable2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
//        $divisions = Division::all()->pluck('id')->toArray();
        $batch_id = $faker->randomElement(Batch::all()->pluck('id')->toArray());
        $school_id = $faker->randomElement(School::all()->pluck('id')->toArray());
        $first_name = $faker->firstName;
        $last_name = $faker->lastName;
        for ($i = 1; $i < 250; $i++) {
            $user = [
                'name'               => $first_name.' '.$last_name,
                'first_name'               => $first_name,
                'last_name'               => $last_name,
                'email'              => $faker->companyEmail,
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'mobile'             => $faker->phoneNumber,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2022-08-02 04:35:32',
                'verification_token' => '',
                'batch_id' => $batch_id,
                'school_id' => $school_id,

            ];
            $user = User::create($user);
            $this->address($user);
            $this->works($user);
            $user->roles()->sync(2);
        }
    }

    public function address($user){
        $faker = Factory::create();
        $division_id = $faker->randomElement(Division::all()->pluck('id')->toArray());
        $district_id = $faker->randomElement(District::where('division_id',$division_id)->get()->pluck('id')->toArray());
        $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
        $union_id = $faker->randomElement(Union::where('upazila_id',$upazila_id)->get()->pluck('id')->toArray());
        $addresses = [
            [
                'area'               => $faker->address,
                'type_of_address'    => 'Permanent',
                'view_on_publicly'   => '1',
                'division_id' => $division_id,
                'district_id' => $district_id,
                'upazila_id' => $upazila_id,
                'union_id' => $union_id,
                'created_by_id' => $user->id,
            ],
            [
                'area'               => $faker->address,
                'type_of_address'    => 'Present',
                'view_on_publicly'   => '1',
                'division_id' => $division_id,
                'district_id' => $district_id,
                'upazila_id' => $upazila_id,
                'union_id' => $union_id,
                'created_by_id' => $user->id,
            ],
        ];

        Address::insert($addresses);

    }
    public function works($user){
        $faker = Factory::create();
        $field_of_work_id = $faker->randomElement(FieldOfWork::all()->pluck('id')->toArray());
        $organization_id = $faker->randomElement(Organization::all()->pluck('id')->toArray());
        $designation_id = $faker->randomElement(Designation::all()->pluck('id')->toArray());
        for ($i = 1; $i < $faker->randomNumber([2,4,5,3]); $i++) {
            $is_current_job = $faker->randomNumber([1,0,0,0,0,0,0,1,0,0]);
            if ($is_current_job==1){
                $resign_date = null;
            }else{
                $resign_date = $faker->date('d-m-Y');
            }
            $work= [
                'joining_date'  => $faker->date('d-m-Y'),
                'resign_date'   => $resign_date,
                'is_current_job'   => $is_current_job,
                'view_on_publicly'   => '1',
                'field_of_work_id' => $field_of_work_id,
                'organization_id' => $organization_id,
                'designation_id' => $designation_id,
                'created_by_id' => $user->id,

            ];
            $work = Work::create($work);
        }
    }
}
