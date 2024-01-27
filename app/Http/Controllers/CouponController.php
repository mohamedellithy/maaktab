<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $coupons = Coupon::query();
        $per_page = 10;
        if($request->has('search')):
            $coupons = $coupons->where('code', 'like', '%' . $request->query('search') . '%');
        endif;

        if($request->has('status')):
            $coupons = $coupons->where('status',$request->query('status'));
        endif;

        $coupons = $coupons->orderBy('id', 'desc');

        if($request->has('rows')):
            $per_page = $request->query('rows');
        endif;

        $coupons = $coupons->paginate($per_page);
        return view('pages.admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products  = Product::query();
        $products = $products->select('id','name')->get();
        return view('pages.admin.coupons.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->input('type_choices') == 'all'):
            $request->merge([
                'products_exist' => -1
            ]);
        else:
            $request->merge([
                'products_exist' => true
            ]);
        endif;
        
        $coupon = Coupon::create([
            'code'          => $request->input('code'),
            'to'            => $request->input('to'),
            'from'          => $request->input('from'),
            'count_used'    => $request->input('count_used'),
            'discount_type' => $request->input('discount_type'),
            'value'         => $request->input('value'),
            'status'        => $request->input('status'),
            'products'      => $request->input('products_exist')
        ]);

        $coupon->product()->sync($request->input('products'));
        
        \Artisan::call('cache:clear');

        flash()->success('تم اضافة الكوبون جديد بنجاح ');
        return redirect()->route('admin.coupons.index')->with('success_message', 'تم انشاء الكوبون بنجاح');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $coupon = Coupon::with('product')->find($id);
        $products  = Product::query();
        $products = $products->select('id','name')->get();
        return view('pages.admin.coupons.edit', compact('coupon','products'));
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
        $coupon = Coupon::find($id);
        if($request->input('type_choices') == 'all'):
            $request->merge([
                'products_exist' => -1
            ]);
        else:
            $request->merge([
                'products_exist' => true
            ]);
        endif;
        
        Coupon::where('id',$id)->update([
            'code'          => $request->input('code'),
            'to'            => $request->input('to'),
            'from'          => $request->input('from'),
            'count_used'    => $request->input('count_used'),
            'discount_type' => $request->input('discount_type'),
            'value'         => $request->input('value'),
            'status'         => $request->input('status'),
            'products'      => $request->input('products_exist')
        ]);

        $coupon->product()->sync($request->input('products'));
        
        \Artisan::call('cache:clear');

        flash()->success('تم تعديل الكوبون جديد بنجاح ');
        return redirect()->route('admin.coupons.index')->with('success_message', 'تم تعديل الكوبون بنجاح');
    
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
        $product = Coupon::destroy($id);

        flash()->success('تم حذف الكوبون بنجاح');
        \Artisan::call('cache:clear');
        return redirect()->route('admin.coupons.index');
    }
}
