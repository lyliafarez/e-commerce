<?php

namespace App\Http\Controllers\api;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',request()->user()->id)->with('role')->get();
        return response(['users'=> $users]);
    }

    //get user status
    public function getStatus( $email){
        $found = User::where('email',$email)->get();
        return response()->json($found);
    }

    //disable User
    public function disableUser(User $user){
        $user->status = 0;
        $user->save();
        return response()->json(['message'=>'user disabled']);
    }

    //enable User
    public function enableUser(User $user){
        $user->status = 1;
        $user->save();
        return response()->json(['message'=>'user enabled']);
    }

    //get admin role id
    public function getAdminRole()
    {
        $AdminRole_id = Role::where('label','Admin')->first()->id;
        return response()->json($AdminRole_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        //get the id of user role
        $userRole_id = Role::where('label','User')->first()->id;

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $userRole_id;
        // status = 1 active user
        $user->status = 1;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message'=>'user added'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->get();
        return response(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
    }

    //pay items in the cart 
    public function purchase(Request $request)
    {   
        $authUser = Auth::user();
        
    
        //return response()->json( $min_dateFormated);
        $user = User::firstOrCreate(
            [
                'email' => $request->input('email')
            ],
            [
                'password' => Hash::make(Str::random(12)),
                'username' => $request->input('first_name'),
                'name' => $request->input('last_name'),
                'role_id' => 1,
                'status' => 1,
            ]
        );
        try {
            $payment = $user->charge(
                $request->input('amount'),
                $request->input('payment_method_id')
            );

            $payment = $payment->asStripePaymentIntent();

            $order = $user->orders()
                ->create([
                    'transaction_id' => $payment->charges->data[0]->id,
                    'total' => $payment->charges->data[0]->amount,

                ]);
               

             foreach (json_decode($request->input('cart'), true) as $item) {
                DB::table('order_product')->insert(['order_id'=>$order->id,'product_id'=>$item['product_id'],'quantity'=>$item['quantity'],'user_id'=>$authUser->id]);
                DB::table('order_purchase')->insert(['purchase_id' => $item['id'],'order_id' => $order->id]);
                DB::table('purchases')->where('user_id',$authUser->id)->update(['command_status'=> 0]);
            }
            $order->load('products'); 

            //sending mail
            $contact = new Contact;
            $contact->userName = $authUser->username;
            $contact->subject = "Shopping order";
            $contact->email = $authUser->email;
            $contact->message = "Your order is being processed";
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

            return $order;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   Order::where('user_id',$user->id)->delete();
        $user->delete();
        return response()->json(['message'=>'user deleted'],200);
    }
}
