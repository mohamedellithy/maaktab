<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\ApplicationOrder;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers   =  User::query();
        $per_page  = 10;
        $customers = User::join('messages', function ($join) {
            $join->on('users.id', '=', 'messages.client_id')
                ->whereIn('messages.id', function ($query) {
                    $query->selectRaw('MAX(id)')
                        ->from('messages')
                        ->groupBy('messages.order_id');
                });
        })->select('users.name','messages.created_at','messages.read','messages.message','messages.order_id');

        $customers->when(request('status') != null, function ($q) {
            return $q->where('read',request('status'));
        });

        $customers->when(request('search') != null, function ($q) {
            return $q->where('name','like', '%' . request('search') . '%')->orWhere('order_id', 'like', '%' . request('search') . '%');
        });

        $customers->when(request('filter') == 'sort_asc', function ($q) {
            return $q->orderBy('created_at','asc');
        });

        $customers->when(request('filter') == 'sort_desc', function ($q) {
            return $q->orderBy('created_at','desc');
        });

        $customers->when(request('filter') == null, function ($q) {
            return $q->orderBy('messages.created_at','desc');
        });

        if(request('rows')):
            $per_page = request('rows');
        endif;

        $customers   = $customers->paginate($per_page);
        return view('pages.admin.discussion.index', compact('customers'));
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
        $order        = Order::where('id',$id)->with('order_attachments','modelable')->first();
        $discussions  = Message::where('order_id',$order->id)->orderBy('id','desc')->paginate(10);
        return view('pages.admin.discussion.show', compact('order','discussions'));
    }

    public function store(Request $request){
        $request->validate([
            'order_id' => [
                'required',
                'exists:orders,id'
            ],
            'client_id' => [
                'required',
                'exists:users,id'
            ]
        ]);


        $discussion = Message::create([
            'message'     => $request->input('message'),
            'attachments' => $request->input('attachments'),
            'client_id'   => $request->input('client_id'),
            'sender'      => 'platform',
            'order_id'    => $request->input('order_id')
        ]);

        return back();
    }
}
