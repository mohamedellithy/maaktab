<?php namespace App\services;

use Illuminate\Support\Facades\Http;
use App\Models\Order;
class ThawaniPayment{
    private static $endpoint    = /*"https://checkout.thawani.om/";*/ "https://uatcheckout.thawani.om/";

    private $enable = true;

    private $api_key = null;

    private $public_key = null;

    private $order_data = [];

    public $result = [];

    public function __construct(){
        $this->enable     = get_settings('thawani_enable');

        if($this->enable == 'active'):
            $this->api_key    = get_settings('thawani_api_key');
            $this->public_key = get_settings('thawani_public_key');
        endif;
    }

    public function create_portal_payment($order_data){

        if($this->enable != 'active') return;

        $this->order_data = $order_data;

        $data = [
            "client_reference_id" => $this->order_data->customer->id,
            "mode"                => "payment",
            "products"            => [
                [
                    "name"        => TrimLongText($this->order_data->order_items->product->name,35),
                    "quantity"    => 1,
                    "unit_amount" => convert_price_to_Omr($this->order_data->order_total,$currency = false) * 1000
                ]
            ],
            "total_amount"=>  convert_price_to_Omr($this->order_data->order_total,$currency = false) * 1000,
            "success_url" => route('payments.success',['order_no' => $this->order_data->order_no]),
            "cancel_url"  => route('single_product',$this->order_data->order_items->product->slug),
            "metadata"    => [
                "Customer Email" => $this->order_data->customer->email,
                "order no"      => $this->order_data->order_no,
                'Currency info' => formate_price($this->order_data->order_total) .' / ' .convert_price_to_Omr($this->order_data->order_total)
            ],
            'currency' => "OMR"
        ];

        $response  = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'thawani-api-key' => $this->api_key,
        ])->post(self::$endpoint.'api/v1/checkout/session',$data);

        $this->result = $response->json();

        if($response->successful()):

            $this->order_data->payment()->updateOrCreate([
                'order_id' => $this->order_data->id,
                'transaction_id' => $this->result['data']['invoice']
            ],[
                'total_payment'  => $this->result['data']['total_amount'] / 1000,
                'status_payment' => $this->result['data']['payment_status']
            ]);

            $this->redirectToPayment($this->result['data']['session_id']);
        else:
            return back();
        endif;
    }

    public function redirectToPayment($session_id){
        redirect(self::$endpoint."pay/{$session_id}?key={$this->public_key}")->send();
    }


    public function success_payment(){
        $order = Order::where([
            'order_no'    => request('order_no'),
            'customer_id' => auth()->user()->id
        ])->first();

        $response = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'thawani-api-key' => $this->api_key,
        ])->get("https://uatcheckout.thawani.om/api/v1/checkout/invoice/".$order->payment->transaction_id);

        

        if($response->successful()):
            $invoice = $response->json();

            $order->payment->update([
                'status_payment' => $invoice['data']['payment_status']
            ]);

            $order->update([
                'order_status' => 'completed'
            ]);

            return redirect()->route('thank_you_payment',$order->order_no)->send();
        endif;
    }
}
