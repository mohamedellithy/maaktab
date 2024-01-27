<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ApplicationOrder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['count_products']   = Project::count();
        $data['count_services']   = Service::count();
        $data['orders_count']     = Order::count();
        $data['last_orders']              = Order::latest()->take(8)->get();
        $data['total_payments']           = Order::where('order_status','completed')->sum('order_total');
        $data['count_users']              = User::customer()->count();
        return view('pages.admin.dashboard',compact('data'));
    }
}
