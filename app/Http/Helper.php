<?php
use App\Models\Page;
use App\Models\Image;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\ApplicationOrder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
if(!function_exists('upload_assets')){
    function upload_assets($image_selected,$is_id = false,$default = 'default.jpg'){
        if($is_id == true):
            $image_selected = Image::find($image_selected);
        endif;

        if($image_selected):
            $value = isset($image_selected->path) ? 'storage/'.$image_selected->path : $default;
        else:
            $value = $default;
        endif;

        return  asset($value);
    }
}

if(!function_exists('get_media_type')){
    function get_media_type($media_url){
        $url_parts = explode('.',$media_url);
        $media_type = null;
        if(count($url_parts) > 0):
            $media_type =  $url_parts[count($url_parts) - 1];
        endif;
        return $media_type;
    }
}

if(!function_exists('IsActiveOnlyIf')){
    function IsActiveOnlyIf($routes = []){
        if(count($routes) == 0) return '';

        $current_route = \Route::currentRouteName();

        if(in_array($current_route,$routes)):
            return 'active open';
        endif;

        return '';
    }
}


if(!function_exists('TrimLongText')){
    function TrimLongText($text,$length = 100){
        $text = trim(strip_tags($text));
        $text  = str_replace('&nbsp;', ' ', $text);
        return mb_substr($text,0,$length).' ... ';
    }
}

if(!function_exists('GetAttachments')) {
    function GetAttachments($attachments_id)
    {
        $media_ids = explode(',', $attachments_id);
        $attachments = Image::whereIn('id', $media_ids)->get();
        return $attachments;
    }
}

if(!function_exists('formate_price')) {
    function formate_price($price)
    {
        return round($price,3).' '.get_settings('website_currency');
    }
}

if(!function_exists('get_price_after_discount')) {
    function get_price_after_discount($product){
        if(($product->discount == null) || ($product->discount == 0)):
            return round($product->price,3);
        else:
            if($product->discount_type == 'value'):
                $discount = ($product->price - $product->discount);
            else:
                $discount = ($product->price - (($product->price * $product->discount) / 100));
            endif;
            return round($discount,3);
        endif;
    }
}

if(!function_exists('html_price')) {
    function html_price($product){
        if(get_price_after_discount($product) == $product->price):
            return formate_price($product->price);
        else:
            return "<b style='text-decoration: line-through red;padding: 0px 10px 0px 0px;'>".
            formate_price($product->price)."</b>".formate_price(get_price_after_discount($product));
        endif;
    }
}

if(!function_exists('convert_price_to_Omr')) {
    function convert_price_to_Omr($price,$currency = true)
    {
        $full_convert = round($price * get_settings('currency_converter'),3);
        if($currency == true):
            $full_convert .= ' '.'OMR';
        endif;
        return $full_convert;
    }
}


if(!function_exists('apply_coupon_code')){
    function apply_coupon_code($coupon,$amount = 0){
        $rest_amount = 0;
        if($coupon->discount_type == 'precent'):
            $rest_amount = round($amount - ($amount  * $coupon->value) / 100,3);
        else:
            $rest_amount = round($amount - $coupon->value,3);
        endif;

        return [
            'amount'           => $amount,
            'rest_amount'      => $rest_amount,
            'USD_amount'       => formate_price($amount),
            'USD_rest_amount'  => formate_price($rest_amount),
            'OMR_amount'       => convert_price_to_Omr($amount),
            'OMR_rest_amount'  => convert_price_to_Omr($rest_amount),
        ];
    }
}

if(!function_exists('check_coupon_exists')){
    function check_coupon_exists($product,$code = null){
        $coupon = Coupon::query();
        $coupon = $coupon->when(auth()->user(),function($query){
            return $query->whereDoesntHave('order',function($q){
                return $q->where('orders.customer_id',auth()->user()->id);
            });
        });

        $coupon = $coupon->when($code != null,function($query) use($code){
            return $query->where('code',$code);
        });
        $coupon = $coupon->whereDate('from','<=',date('Y-m-d'));
        $coupon = $coupon->whereDate('to','>=',date('Y-m-d'));
        $coupon = $coupon->where('status','=','active');
        $coupon = $coupon->whereHas('product',function($query) use($product){
            return $query->where('product_id',$product->id);
        });
        $coupon = $coupon->where('products','!=','-1')->first();

        if($coupon == null){
            $coupon = Coupon::query();
            $coupon = $coupon->when(auth()->user(),function($query){
                return $query->whereDoesntHave('order',function($q){
                    return $q->where('orders.customer_id',auth()->user()->id);
                });
            });
            $coupon = $coupon->when($code != null,function($query) use($code){
                return $query->where('code',$code);
            });
            $coupon = $coupon->whereDate('from','<=',date('Y-m-d'));
            $coupon = $coupon->whereDate('to','>=',date('Y-m-d'));
            $coupon = $coupon->where('status','=','active');
            $coupon = $coupon->where('products','=','-1')->first();
        }

        return $coupon;
    }
}

if(!function_exists('filter_orders')) {
    function filter_orders($orders)
    {
        $orders->when(request('order_status') != null, function ($q) {
            return $q->where('order_status', request('order_status'));
        });

        $orders->when(request('search') != null, function ($q) {
            return $q->where('order_no', 'like', '%' . request('search') . '%')->orWhereHas('customer', function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        });

        $orders->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at', 'asc');
        });

        $orders->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at', 'desc');
        });

        return $orders;
    }
}


if(!function_exists('filter_payments')) {
    function filter_payments($payments)
    {
        $payments->when(request('status_payment') != null, function ($q) {
            return $q->where('status_payment', request('status_payment'));
        });

        $payments->when(request('search') != null, function ($q) {
            return $q->orWhereHas('order', function ($query) {
                $query->where('order_no', 'like', '%' . request('search') . '%');
            })->orWhereHas('order.customer', function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        });

        $payments->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at', 'asc');
        });

        $payments->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at', 'desc');
        });

        return $payments;
    }
}


if(!function_exists('IsPagesAllowDeletes')){
    function IsPagesAllowDeletes($page){
        if(!isset($page)) return false;

        if(!in_array($page,[
            '/',
            'shop',
            'services',
            'contact-us'
        ])):
            return true;
        endif;

        return false;
    }
}

if(!function_exists('IsNotAllowPagesChangeSlug')){
    function IsNotAllowPagesChangeSlug($page){
        if(!isset($page)) return false;

        if(!in_array($page,[
            '/',
            'shop',
            'services',
            'contact-us'
        ])):
            return true;
        endif;

        return false;
    }
}

if(!function_exists('platformSettings')){
    function platformSettings($option = null,$whereCondition = []){
        if(!isset($setting)):
            $setting = Setting::query();
            if(count($whereCondition) > 0 ):
                $setting = $setting->where($whereCondition);
            endif;
            $setting = $setting->pluck('value','name')->toArray();
        endif;

        if(isset($option)) return $setting[$option];

        return $setting;
    }
}

if(!function_exists('ActivePagesMenus')){
    function ActivePagesMenus($whereCondition = []){

        $pages = Cache::rememberForever('all-pages',function(){
            $pages = Page::where([
                ['status','=','active'],
            ])->orderby('menu_position','asc')->get();
            return $pages;
        });

        if(count($whereCondition) > 0):
            list($column,$condition,$value) = $whereCondition;
            return array_values(collect($pages)->where($column,$condition,$value)->all());
        endif;

        return $pages;
    }
}


if(!function_exists('get_settings')){
    function get_settings($key = null){
        $settings = Cache::rememberForever('all-settings',function(){
            return Setting::all();
        });

        if($key == null):
            $settings = collect($settings)->pluck('value','name')->toArray();
            return $settings;
        else:
            $setting  =  collect($settings)->where('name','=',$key)->first();
            return $setting ? $setting->value : null;
        endif;
    }
}

if(!function_exists('ImageInfo')){
    function ImageInfo($image_id = null){
        if(!isset($image_id)) return null;

        $image = Image::find($image_id);
        return $image;
    }
}

if(!function_exists('fetchImageInnerDetails')){
    function fetchImageInnerDetails($image){
        if(!isset($image)) return '-';

        $image  = explode('/',$image->path);
        return $image[count($image) - 1];
    }
}

if(!function_exists('getOriginalSizeWithOriginalUnit')){
    function getOriginalSizeWithOriginalUnit($bytes){
        if($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
        } else {
            return '0 B';
        }
    }
}

if(!function_exists('formateMediaType')){
    function formateMediaType($type){
        if(!isset($type)) return 'image';

        return explode('/',$type);
    }
}

if(!function_exists('customer_allow_to_review_product')){
    function customer_allow_to_review_product($product_id){
        if(!isset($product_id)) return false;

        if(!auth()->user()) return false;

        $has_products = \App\Models\Order::where([
            'customer_id'  => auth()->user()->id,
            'order_status' => 'completed'
        ])->whereHas('order_items',function($query) use($product_id){
            return $query->where('order_items.product_id',$product_id);
        })->exists();

        return $has_products;
    }
}

if(!function_exists('count_unread_model')){
    function count_unread_model($model){
        if(!isset($model)) return null;

        $count_result = 0;

        if($model == "Order"):
            $count_result = Order::where([
                'read' => 0
            ])->count();
        endif;

        return $count_result;
    }
}


if(!function_exists('get_status_html')){
    function get_status_html($status){
        $status_text = __('master.'.$status);
        $html = "";
        if($status == 'pending'){
            $html =  "<span class='badge' style='background-color: #4A148C !important;'>{$status_text}</span>";
        }
        elseif($status == 'progress'){
            $html =  "<span class='badge' style='background-color:#1c1c9e !important;'>{$status_text}</span>";
        }
        elseif($status == 'completed'){
            $html =  "<span class='badge' style='background-color:green !important;'>{$status_text}</span>";
        }
        elseif($status == 'cancelled'){
            $html =  "<span class='badge' style='background-color:red !important;'>{$status_text}</span>";
        }
        elseif($status == 'success'){
            $html =  "<span class='badge' style='background-color:green !important;'>{$status_text}</span>";
        }
        elseif($status == 'failed'){
            $html =  "<span class='badge' style='background-color:red !important;'>{$status_text}</span>";
        }
        elseif($status == 'accepted'){
            $html =  "<span class='badge' style='background-color:green !important;'>{$status_text}</span>";
        }
        elseif($status == 'refused'){
            $html =  "<span class='badge' style='background-color:red !important;'>{$status_text}</span>";
        }
        elseif($status == 'wait'){
            $html =  "<span class='badge' style='background-color:#1c1c9e !important;'>{$status_text}</span>";
        }

        return $html;
    }
}

if(!function_exists('CountriesPhonesCode')){
    function CountriesPhonesCode($code = null){
        $codes = [
            '44' => 'UK (+44)',
            '1' => 'USA (+1)',
            '213' => 'Algeria (+213)',
            '376' => 'Andorra (+376)',
            '244' => 'Angola (+244)',
            '1264' => 'Anguilla (+1264)',
            '1268' => 'Antigua & Barbuda (+1268)',
            '54' => 'Argentina (+54)',
            '374' => 'Armenia (+374)',
            '297' => 'Aruba (+297)',
            '61' => 'Australia (+61)',
            '43' => 'Austria (+43)',
            '994' => 'Azerbaijan (+994)',
            '1242' => 'Bahamas (+1242)',
            '973' => 'Bahrain (+973)',
            '880' => 'Bangladesh (+880)',
            '1246' => 'Barbados (+1246)',
            '375' => 'Belarus (+375)',
            '32' => 'Belgium (+32)',
            '501' => 'Belize (+501)',
            '229' => 'Benin (+229)',
            '1441' => 'Bermuda (+1441)',
            '975' => 'Bhutan (+975)',
            '591' => 'Bolivia (+591)',
            '387' => 'Bosnia Herzegovina (+387)',
            '267' => 'Botswana (+267)',
            '55' => 'Brazil (+55)',
            '673' => 'Brunei (+673)',
            '359' => 'Bulgaria (+359)',
            '226' => 'Burkina Faso (+226)',
            '257' => 'Burundi (+257)',
            '855' => 'Cambodia (+855)',
            '237' => 'Cameroon (+237)',
            '1' => 'Canada (+1)',
            '238' => 'Cape Verde Islands (+238)',
            '1345' => 'Cayman Islands (+1345)',
            '236' => 'Central African Republic (+236)',
            '56' => 'Chile (+56)',
            '86' => 'China (+86)',
            '57' => 'Colombia (+57)',
            '269' => 'Comoros (+269)',
            '242' => 'Congo (+242)',
            '682' => 'Cook Islands (+682)',
            '506' => 'Costa Rica (+506)',
            '385' => 'Croatia (+385)',
            '53' => 'Cuba (+53)',
            '90392' => 'Cyprus North (+90392)',
            '357' => 'Cyprus South (+357)',
            '42' => 'Czech Republic (+42)',
            '45' => 'Denmark (+45)',
            '253' => 'Djibouti (+253)',
            '1809' => 'Dominica (+1809)',
            '1809' => 'Dominican Republic (+1809)',
            '593' => 'Ecuador (+593)',
            '20' => 'Egypt (+20)',
            '503' => 'El Salvador (+503)',
            '240' => 'Equatorial Guinea (+240)',
            '291' => 'Eritrea (+291)',
            '372' => 'Estonia (+372)',
            '251' => 'Ethiopia (+251)',
            '500' => 'Falkland Islands (+500)',
            '298' => 'Faroe Islands (+298)',
            '679' => 'Fiji (+679)',
            '358' => 'Finland (+358)',
            '33' => 'France (+33)',
            '594' => 'French Guiana (+594)',
            '689' => 'French Polynesia (+689)',
            '241' => 'Gabon (+241)',
            '220' => 'Gambia (+220)',
            '7880' => 'Georgia (+7880)',
            '49' => 'Germany (+49)',
            '233' => 'Ghana (+233)',
            '350' => 'Gibraltar (+350)',
            '30' => 'Greece (+30)',
            '299' => 'Greenland (+299)',
            '1473' => 'Grenada (+1473)',
            '590' => 'Guadeloupe (+590)',
            '671' => 'Guam (+671)',
            '502' => 'Guatemala (+502)',
            '224' => 'Guinea (+224)',
            '245' => 'Guinea - Bissau (+245)',
            '592' => 'Guyana (+592)',
            '509' => 'Haiti (+509)',
            '504' => 'Honduras (+504)',
            '852' => 'Hong Kong (+852)',
            '36' => 'Hungary (+36)',
            '354' => 'Iceland (+354)',
            '91' => 'India (+91)',
            '62' => 'Indonesia (+62)',
            '98' => 'Iran (+98)',
            '964' => 'Iraq (+964)',
            '353' => 'Ireland (+353)',
            '972' => 'Israel (+972)',
            '39' => 'Italy (+39)',
            '1876' => 'Jamaica (+1876)',
            '81' => 'Japan (+81)',
            '962' => 'Jordan (+962)',
            '7' => 'Kazakhstan (+7)',
            '254' => 'Kenya (+254)',
            '686' => 'Kiribati (+686)',
            '850' => 'Korea North (+850)',
            '82' => 'Korea South (+82)',
            '965' => 'Kuwait (+965)',
            '996' => 'Kyrgyzstan (+996)',
            '856' => 'Laos (+856)',
            '371' => 'Latvia (+371)',
            '961' => 'Lebanon (+961)',
            '266' => 'Lesotho (+266)',
            '231' => 'Liberia (+231)',
            '218' => 'Libya (+218)',
            '417' => 'Liechtenstein (+417)',
            '370' => 'Lithuania (+370)',
            '352' => 'Luxembourg (+352)',
            '853' => 'Macao (+853)',
            '389' => 'Macedonia (+389)',
            '261' => 'Madagascar (+261)',
            '265' => 'Malawi (+265)',
            '60' => 'Malaysia (+60)',
            '960' => 'Maldives (+960)',
            '223' => 'Mali (+223)',
            '356' => 'Malta (+356)',
            '692' => 'Marshall Islands (+692)',
            '596' => 'Martinique (+596)',
            '222' => 'Mauritania (+222)',
            '269' => 'Mayotte (+269)',
            '52' => 'Mexico (+52)',
            '691' => 'Micronesia (+691)',
            '373' => 'Moldova (+373)',
            '377' => 'Monaco (+377)',
            '976' => 'Mongolia (+976)',
            '1664' => 'Montserrat (+1664)',
            '212' => 'Morocco (+212)',
            '258' => 'Mozambique (+258)',
            '95' => 'Myanmar (+95)',
            '264' => 'Namibia (+264)',
            '674' => 'Nauru (+674)',
            '977' => 'Nepal (+977)',
            '31' => 'Netherlands (+31)',
            '687' => 'New Caledonia (+687)',
            '64' => 'New Zealand (+64)',
            '505' => 'Nicaragua (+505)',
            '227' => 'Niger (+227)',
            '234' => 'Nigeria (+234)',
            '683' => 'Niue (+683)',
            '672' => 'Norfolk Islands (+672)',
            '670' => 'Northern Marianas (+670)',
            '47' => 'Norway (+47)',
            '968' => 'Oman (+968)',
            '680' => 'Palau (+680)',
            '507' => 'Panama (+507)',
            '675' => 'Papua New Guinea (+675)',
            '595' => 'Paraguay (+595)',
            '51' => 'Peru (+51)',
            '63' => 'Philippines (+63)',
            '48' => 'Poland (+48)',
            '351' => 'Portugal (+351)',
            '1787' => 'Puerto Rico (+1787)',
            '974' => 'Qatar (+974)',
            '262' => 'Reunion (+262)',
            '40' => 'Romania (+40)',
            '7' => 'Russia (+7)',
            '250' => 'Rwanda (+250)',
            '378' => 'San Marino (+378)',
            '239' => 'Sao Tome & Principe (+239)',
            '966' => 'Saudi Arabia (+966)',
            '221' => 'Senegal (+221)',
            '381' => 'Serbia (+381)',
            '248' => 'Seychelles (+248)',
            '232' => 'Sierra Leone (+232)',
            '65' => 'Singapore (+65)',
            '421' => 'Slovak Republic (+421)',
            '386' => 'Slovenia (+386)',
            '677' => 'Solomon Islands (+677)',
            '252' => 'Somalia (+252)',
            '27' => 'South Africa (+27)',
            '34' => 'Spain (+34)',
            '94' => 'Sri Lanka (+94)',
            '290' => 'St. Helena (+290)',
            '1869' => 'St. Kitts (+1869)',
            '1758' => 'St. Lucia (+1758)',
            '249' => 'Sudan (+249)',
            '597' => 'Suriname (+597)',
            '268' => 'Swaziland (+268)',
            '46' => 'Sweden (+46)',
            '41' => 'Switzerland (+41)',
            '963' => 'Syria (+963)',
            '886' => 'Taiwan (+886)',
            '7' => 'Tajikstan (+7)',
            '66' => 'Thailand (+66)',
            '228' => 'Togo (+228)',
            '676' => 'Tonga (+676)',
            '1868' => 'Trinidad & Tobago (+1868)',
            '216' => 'Tunisia (+216)',
            '90' => 'Turkey (+90)',
            '7' => 'Turkmenistan (+7)',
            '993' => 'Turkmenistan (+993)',
            '1649' => 'Turks & Caicos Islands (+1649)',
            '688' => 'Tuvalu (+688)',
            '256' => 'Uganda (+256)',
            '380' => 'Ukraine (+380)',
            '971' => 'United Arab Emirates (+971)',
            '598' => 'Uruguay (+598)',
            '7' => 'Uzbekistan (+7)',
            '678' => 'Vanuatu (+678)',
            '379' => 'Vatican City (+379)',
            '58' => 'Venezuela (+58)',
            '84' => 'Vietnam (+84)',
            '84' => 'Virgin Islands - British (+1284)',
            '84' => 'Virgin Islands - US (+1340)',
            '681' => 'Wallis & Futuna (+681)',
            '969' => 'Yemen (North)(+969)',
            '967' => 'Yemen (South)(+967)',
            '260' => 'Zambia (+260)',
            '263' => 'Zimbabwe (+263)',
        ];

        return $code ? $codes[$code] : $codes;
    }
}


if(!function_exists('LengthCountriesPhonesNo')) {
    function LengthCountriesPhonesNo($code = null)
    {
        $arr = [
            '972'=> 9,
            '93'=> 9,
            '213'=> 9,
            '1264'=> 10,
            '1268'=> 10,
            '374'=> 8,
            '297'=> 7,
            '61'=> 9,
            '43'=> 10,
            '994'=> 9,
            '1242'=> 10,
            '973'=> 8,
            '880'=> 10,
            '1246' => 10,
            '375'=> 9,
            '32'=> 9,
            '501'=> 7,
            '229'=> 9,
            '1441'=> 10,
            '387'=> 8,
            '55'=> 11,
            '226'=> 8,
            '855'=> 9,
            '237'=> 9,
            '1'=> 10,
            '345'=> 10,
            '235'=> 8,
            '56'=> 9,
            '86'=> 13,
            '57'=> 10,
            '682'=> 5,
            '506'=> 8,
            '385'=> 9,
            '537'=> 8,
            '420'=> 9,
            '45'=> 8,
            '1767'=> 10,
            '1849'=> 10,
            '593'=> 9,
            '20'=> 10,
            '503'=> 8,
            '372'=> 8,
            '298'=> 5,
            '594'=> 9,
            '689'=> 6,
            '241'=> 7,
            '995'=> 9,
            '49'=> 10,
            '233'=> 9,
            '30'=> 10,
            '299'=> 6,
            '1473'=> 10,
            '590'=> 9,
            '1671'=> 10,
            '502'=> 8,
            '504'=> 8,
            '36'=> 9,
            '91'=> 10,
            '62'=> 9,
            '353'=> 9,
            '39'=> 10,
            '1876'=> 10,
            '81'=> 10,
            '962'=> 9,
            '77'=> 10,
            '254'=> 10,
            '686'=> 8,
            '965'=> 8,
            '371'=> 8,
            '961'=> 7,
            '231'=> 7,
            '370'=> 8,
            '352'=> 9,
            '60'=> 7,
            '960'=> 7,
            '223'=> 8,
            '356'=> 8,
            '692'=> 7,
            '596'=> 9,
            '230'=> 8,
            '52'=> 10,
            '382'=> 8,
            '1664'=> 10,
            '95'=> 8,
            '977'=> 10,
            '31'=> 9,
            '687'=> 6,
            '64'=> 9,
            '505'=> 8,
            '227'=> 8,
            '234'=> 8,
            '683'=> 4,
            '1670'=> 10,
            '47'=> 8,
            '968'=> 8,
            '92'=> 10,
            '680'=> 7,
            '507'=> 8,
            '595'=> 9,
            '51'=> 9,
            '63'=> 10,
            '48'=> 9,
            '351'=> 9,
            '1939'=> 10,
            '974'=> 8,
            '40'=> 10,
            '685'=> 5,
            '966'=> 9,
            '381'=> 8,
            '65'=> 8,
            '421'=> 9,
            '677'=> 7,
            '27'=> 9,
            '34'=> 9,
            '94'=> 7,
            '46'=> 7,
            '41'=> 9,
            '66'=> 9,
            '228'=> 8,
            '1868'=> 10,
            '216'=> 8,
            '90'=> 10,
            '1649'=> 10,
            '380'=> 9,
            '971'=> 9,
            '44'=> 10,
            '967'=> 9,
            '260'=> 9,
            '263'=> 9,
            '852'=> 8,
            '258'=> 12,
            '7'=> 10,
            '1869'=> 10,
            '1758'=> 10,
            '1784'=> 10,
            '252'=> 8
        ];

        return $code ? $arr[$code] : $arr;
    }
}
