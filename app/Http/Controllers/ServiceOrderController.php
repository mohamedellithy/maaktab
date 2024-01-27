<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationOrder;
class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $application_orders   =  ApplicationOrder::query();
        $application_orders   =  $application_orders->with('customer','service');
        $per_page = 10;

        $application_orders->when(request('search') != null, function ($q) {
            return $q->WhereHas('customer',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            })->orWhereHas('service',function($query){
                $query->where('name', 'like', '%' . request('search') . '%');
            });
        });

        if($request->has('rows')):
            $per_page = $request->query('rows');
        endif;

        $application_orders->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $application_orders->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $application_orders->when(!request('filter'), function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $application_orders   = $application_orders->paginate($per_page);
        return view('pages.admin.services_orders.index', compact('application_orders'));
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
        $application_order = ApplicationOrder::with('customer','service')->where('id',$id)->first();
        if($application_order->read == 0):
            $application_order->update([
                'read' => 1
            ]);
        endif;
        return view('pages.admin.services_orders.show', compact('application_order'));
    }
}
