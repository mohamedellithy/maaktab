<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Proposal;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $orders   =  Order::query();
        $orders   =  $orders->with('customer','order_items','order_items.product');
        $per_page = 10;
        $orders->when(request('order_status') != null, function ($q) {
            return $q->where('order_status',request('order_status'));
        });

        $orders->when(request('search') != null, function ($q) {
            return $q->where('order_no','like', '%' . request('search') . '%')->orWhereHas('customer',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        });

        $orders->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $orders->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $orders->when(!request('filter'), function ($q) {
            return $q->orderBy('created_at','desc');
        });

        if($request->has('rows')):
            $per_page = $request->query('rows');
        endif;

        $orders   = $orders->paginate($per_page);
        return view('pages.admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order     = Order::where('order_no',$id)->with('order_attachments','modelable')->first();
        $proposals = Proposal::where('order_id',$order->id)->orderBy('id','desc')->paginate(10);
        if($order->read == 0):
            $order->update([
                'read' => 1
            ]);
        endif;
        return view('pages.admin.orders.show', compact('order','proposals'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::where('order_no',$id)->update([
            'order_status' => $request->input('order_status')
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
