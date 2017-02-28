<?php

use Illuminate\Database\Seeder;
use App\Company;
class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
//        DB::insert('INSERT INTO 'company' ('name','descrription') VALUES (?,?)'),
//                        [
//                            '1Company',
//                            'Company created with CompanyTableSeeder'
//                        ]);
        //2
        DB::table('company')->insert([
//         [
            ['name' => 'Company1',
             'description' => 'Company created with CompanyTableSeeder',
               'img'=>'one.jpg'
            ],
            ['name' => 'Company2',
             'description' => 'Company created with CompanyTableSeeder',
                'img'=>'two.jpg'
            ]

        ]);
        //3
        Company::create([
             'name' => 'Company3',
             'description' => 'Company created with model Company',
             'img'=>'thre.jpg'
      ]);
    }
}
