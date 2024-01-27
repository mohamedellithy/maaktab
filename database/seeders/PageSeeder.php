<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Page::updateOrCreate([
            'title'    => 'الرئيسية',
            'slug'     => '/',
            'thumbnail_id'    => null,
            'content'  => '',
            'position' => 'header',
            'status'   => 'active',
            'meta_title'=> 'الرئيسية',
            'meta_description' => 'الرئيسية',
            'menu_position'    => '8'
        ]);

        Page::updateOrCreate([
            'title'    => 'المنتجات',
            'slug'     => 'shop',
            'thumbnail_id'    => null,
            'content'  => '',
            'position' => 'header',
            'status'   => 'active',
            'meta_title'=> 'المنتجات',
            'meta_description' => 'المنتجات',
            'menu_position'    => '40'
        ]);

        Page::updateOrCreate([
            'title'    => 'الخدمات',
            'slug'     => 'service',
            'thumbnail_id'    => null,
            'content'  => '',
            'position' => 'header',
            'status'   => 'active',
            'meta_title'=> 'الخدمات',
            'meta_description' => 'الخدمات',
            'menu_position'    => '30'
        ]);

        Page::updateOrCreate([
            'title'    => 'تواصل معنا',
            'slug'     => 'contact-us',
            'thumbnail_id'    => null,
            'content'  => '',
            'position' => 'header',
            'status'   => 'active',
            'meta_title'=> 'تواصل معنا',
            'meta_description' => 'تواصل معنا',
            'menu_position'    => '60'
        ]);

        Page::updateOrCreate([
            'title'    => 'من نحن',
            'slug'     => 'من-نحن',
            'thumbnail_id'    => null,
            'content'  => '',
            'position' => 'header',
            'status'   => 'active',
            'meta_title'=> 'من نحن',
            'meta_description' => 'من نحن',
            'menu_position'    => '20'
        ]);

        Page::updateOrCreate([
            'title'    => 'سياسة الخصوصية',
            'slug'     => 'سياسة-الخصوصية',
            'thumbnail_id'    => null,
            'content'  => '',
            'position' => 'header',
            'status'   => 'active',
            'meta_title'=> 'سياسة الخصوصية',
            'meta_description' => 'سياسة الخصوصية',
            'menu_position'    => '50'
        ]);
    }
}
