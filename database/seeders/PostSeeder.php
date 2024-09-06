<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      //php artisan db:seed --class=CountrySeeder     
        
        $post =

        [
              [
                "id" => 1,
                "title" => "Flutter",
                "subject" => "Flutter is an open-source UI software development kit for creating natively compiled applications for mobile, 
                web, and desktop from a single codebase.   
                ",
              ],
              [
                "id" => 2,
                "title" => "الكبسة",
                "subject" => "الكبسة هي طبق عربي شهير يتكون بشكل أساسي من الأرز البسمتي المطهو مع اللحم أو الدجاج، ويضاف إليه مجموعة متنوعة 
                من التوابل والمكسرات، ويقدم عادة مع الخضروات والسلطات.
                ",
              ],
              [
                "id" => 3,
                "title" => "Noodles",
                "subject" => "Noodles are a staple food in many cultures,
                 made from a variety of flours and served in countless ways.
 
                ",
              ],
              [
                "id" => 4,
                "title" => "لارافيل",
                "subject" => "Laravel هو إطار عمل PHP مفتوح المصدر مصمم لتسريع عملية تطوير تطبيقات الويب.
                ",
              ],
            
              

              [
                "id" => 5,
                "title" => "لارافيل",
                "subject" => "Laravel هو إطار عمل PHP مفتوح المصدر مصمم لتسريع عملية تطوير تطبيقات الويب.
                ",
              ],
              [
                "id" => 6,
                "title" => "Brazil",
                "subject" => "Brazil is a vibrant country in South America 
                known for its diverse culture, ",
              ],
             
        ]; 
        DB::table('posts')->insert($post);       
    }
}