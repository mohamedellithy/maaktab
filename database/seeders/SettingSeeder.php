<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Setting::insert([
            [
                "name" => "website_name",
                "value"=> "الخطوة الرائدة للتجارة و الاستثمار"
            ],
            [
                "name" => "admin_email",
                "value"=> "admin@djazairelkheir.com"
            ],
            [
                "name" => "website_currency",
                "value"=> "SAR"
            ],
            [
                "name" => "social_facebook",
                "value"=> "#"
            ],
            [
                "name" => "social_twitter",
                "value"=> "#"
            ],
            [
                "name" => "social_insta",
                "value"=> "#"
            ],
            [
                "name" => "website_linkedin",
                "value"=> "#"
            ],
            [
                "name" => "social_youtube",
                "value"=> "#"
            ],
            [
                "name" => "website_whastapp",
                "value"=> "201026051966"
            ],
            [
                "name" => "website_logo",
                "value"=> ""
            ],
            [
                "name" => "meta_title",
                "value"=> ""
            ],
            [
                "name" => "meta_description",
                "value"=> ""
            ],
            [
                "name" => "thawani_enable",
                "value"=> "active"
            ],
            [
                "name" => "thawani_api_key",
                "value"=> "rRQ26GcsZzoEhbrP2HZvLYDbn9C9et"
            ],
            [
                "name" => "thawani_public_key",
                "value"=> "HGvTMLDssJghr9tlN9gr4DVYt0qyBy"
            ],
            [
                "name" => "thawani_logo",
                "value"=> ""
            ],
            [
                "name" => "payments",
                "value"=> "thawani"
            ],
            [
                "name" => "thawani_title",
                "value"=> "ثوانى للدفع الالكترونى"
            ],
            [
                "name" => "website_address",
                "value"=> "مدينة الرياض حي المدينة الصناعية الجديدة عمارة رقم 12"
            ],
            [
                "name" => "website_location_map",
                "value"=> '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118833.70252939525!2d39.72464916088559!3d21.446799873768818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c21b4ced818775%3A0x98ab2469cf70c9ce!2sMecca%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1691155480604!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ],
            [
                "name" => "reviews_enable",
                "value"=> "active"
            ],
        ]);
    }
}
