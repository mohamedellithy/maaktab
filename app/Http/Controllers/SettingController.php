<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{

    public function settings_general(){
       return view('pages.admin.settings.general');
    }

    public function save_general_setting(Request $request){
        if(!request('reviews_enable')):
            $request->merge([
                'reviews_enable' => null
            ]);
        endif;
        $settings = $request->only([
            'website_name',
            'admin_email',
            'website_currency',
            'website_whastapp',
            'social_facebook',
            'social_twitter',
            'social_insta',
            'website_linkedin',
            'social_youtube',
            'website_logo',
            'meta_title',
            'meta_description',
            'website_address',
            'website_location_map',
            'reviews_enable'
        ]);
        foreach($settings as $name => $value):
            Setting::updateOrCreate([
                'name' => $name
            ],[
                'value'=> $value,
                'type' => 'general'
            ]);
        endforeach;

        \Artisan::call('cache:clear');
        flash()->success('تم تحديث اعدادات المنصة بنجاح ');
        return redirect()->back();
    }

    public function settings_payments(){
        return view('pages.admin.settings.payments');
    }

    public function save_settings_payments(Request $request){
        if(count($request->input('payments')) > 0):
            Setting::updateOrCreate([
                'name' => 'payments'
            ],[
                'value'=> implode('-',$request->input('payments')),
                'type' => 'payments'
            ]);
        endif;

        foreach($request->input('payments') as $payment):
            $settings = $request->only([
                $payment.'_enable',
                $payment.'_api_key',
                $payment.'_public_key',
                $payment.'_logo',
                $payment.'_title'
            ]);
            foreach($settings as $name => $value):
                Setting::updateOrCreate([
                    'name' => $name
                ],[
                    'value'=> $value,
                    'type' => 'payments'
                ]);
            endforeach;
        endforeach;

        \Artisan::call('cache:clear');

        flash()->success('تم تحديث اعدادات بوابات الدفع بنجاح ');

        return redirect()->back();
    }
}
