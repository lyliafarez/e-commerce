<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['products','purchases'])->get();
        return response()->json($orders);
    }
    
    

    public function dateFormatted(Order $order)
    {
        $date = date_format($order->created_at,'d-m-Y');
        return response()->json($date);
    }

    public function DeliveryIntervalDate(Order $order)
    {
        $currentDateTime = $order->created_at ;
        $newDateTime =  $order->created_at->addDays(10);
        $newMaxDateTime = $order->created_at->addDays(15);

        
        $max_dateFormated = date_format($newMaxDateTime,'d-m-Y');
        $min_dateFormated = date_format($newDateTime,'d-m-Y');

        return response()->json([
            'min_date' =>  $min_dateFormated,
            'max_date' =>  $max_dateFormated,
            
        ]);
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

    // shipping status to switch
    public function shipped($id){
        $authUser = Auth::user();
        $MyOrder = Order::where('id',$id)->first();
        $MyOrder->update(['shipping_status' => 1]);
        $MyOrder->save();
        
        
        
        //sending mail
        $contact = new Contact;
        $contact->userName = $authUser->username;
        $contact->subject = "Shopping order";
        $contact->email = $authUser->email;
        $contact->message = "Your order was shipped";
        $contact->save();

        Mail::send('mail.orderMail', array(
            'subject' => $contact->subject,
            'username' => $contact->userName,
            'email' => $contact->email,
            'body' => $contact->message,
        ), function($message) use ($contact){
            $message->from('Shopping@heliop.com', 'Hello User');
            $message->to($contact->email)->subject($contact->subject);
        });   

        return response()->json(['message'=>'your order is being shipped']);
    }
    // delivery status to switch
    public function delivered($id){
        $authUser = Auth::user();
        $MyOrder = Order::where('id',$id)->first();
        $MyOrder->update(['delivery_status' => 1,'shipping_status'=>0]);
        $MyOrder->save();

        //sending mail
        $contact = new Contact;
        $contact->userName = $authUser->username;
        $contact->subject = "Shopping order";
        $contact->email = $authUser->email;
        $contact->message = "Your order is being delivered";
        $contact->save();

        Mail::send('mail.orderMail', array(
            'subject' => $contact->subject,
            'username' => $contact->userName,
            'email' => $contact->email,
            'body' => $contact->message,
        ), function($message) use ($contact){
            $message->from('Shopping@heliop.com', 'Hello User');
            $message->to($contact->email)->subject($contact->subject);
        });   
        return response()->json(['message'=>'your order is being delivered']);
    }

    //reception status to switch
    public function received($id){
        $authUser = Auth::user();
        $MyOrder = Order::where('id',$id)->first();
        $MyOrder->update(['reception_status' => 1,'delivery_status' => 0]);
        $MyOrder->save();

        //sending mail
        $contact = new Contact;
        $contact->userName = $authUser->username;
        $contact->subject = "Shopping order";
        $contact->email = $authUser->email;
        $contact->message = "Order received !";
        $contact->save();

        Mail::send('mail.orderMail', array(
            'subject' => $contact->subject,
            'username' => $contact->userName,
            'email' => $contact->email,
            'body' => $contact->message,
        ), function($message) use ($contact){
            $message->from('Shopping@heliop.com', 'Hello User');
            $message->to($contact->email)->subject($contact->subject);
        });   
        return response()->json(['message'=>'the order is  received']);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $myOrders = Order::where('user_id',Auth::user()->id)->with(['products','purchases'])->get();
        return response()->json($myOrders);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'order deleted']);
    }
}
