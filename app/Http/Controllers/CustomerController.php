<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\ApplicationOrder;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers   =  User::query()->customer();
        $per_page = 10;
        $customers->when(request('status') != null, function ($q) {
            return $q->where('status',request('status'));
        });

        $customers->when(request('search') != null, function ($q) {
            return $q->where('name','like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%');
        });

        $customers->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $customers->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $customers->when(request('filter') == null, function ($q) {
            return $q->orderBy('created_at','desc');
        });

        if(request('rows')):
            $per_page = request('rows');
        endif;

        $customers   = $customers->paginate($per_page);
        return view('pages.admin.customers.index', compact('customers'));
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
        $customer   =  User::customer()->withCount('orders','application_orders')->find($id);
        return view('pages.admin.customers.show', compact('customer'));
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
        $customer   =  User::customer()->where('id',$id)->update([
            'status' => request('status')
        ]);

        flash()->success('تم تحديث الحالة بنجاح ');

        return redirect()->back();
    }

    public function services_orders($id){
        $rows  = request('rows') ?: 10;
        $customer =  User::customer()->find($id);
        $application_orders   =  ApplicationOrder::query();
        $application_orders   =  $application_orders->with('service','customer');
        $application_orders->where('customer_id',$id);
        $application_orders->when(request('search') != null, function ($q) {
            return $q->WhereHas('customer',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orWhereHas('service',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        });
        $application_orders   =  $application_orders->paginate($rows);
        return view('pages.admin.customers.orders.services', compact('application_orders','customer'));
    }

    public function products_orders($id){
        $customer =  User::customer()->find($id);
        $orders   =  Order::query();
        $orders   =  $orders->where('customer_id',$id);
        $orders   =  filter_orders($orders);
        $orders   =  $orders->paginate(10);
        return view('pages.admin.customers.orders.products', compact('orders','customer'));
    }
}
