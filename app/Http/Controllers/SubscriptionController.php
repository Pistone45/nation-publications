<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use DateTime;
use App\Models\Status;
use App\Models\User;
use App\Models\Receipt;
use App\Models\UserSubscription;
use App\Models\Region;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Session;
use PDF;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

        $user_id= Auth::user()->id;

        //getting the subscription
        $subscriptions = Subscription::all();
        $subs = UserSubscription::where('user_id', $user_id)->where('status_id', 1)
        ->get();
        $sub = $subs->first();

        $sub_id = 0;
        $found = 0;
        if($sub == null){
            $found = 0;

        }else{
            $found = 1;
            $sub_id = $sub->id;
        }

        return view('subscriptions/index', [
            'subscriptions' => $subscriptions,
            'found' => $found,
            'sub_id' => $sub_id,
        ]);
        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to fetch roles');
        }
    }

    //Get all customers
    public function subscribers()
    {
        try{
        //getting the users
        $users = User::where('role_id', 1)
        ->get();

        return view('subscriptions/subscribers', [
            'users' => $users
        ]);

        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to fetch Customers');
        }
    }

    //Datatable for customers
    public function get(Request $request)
    {
        if ($request->ajax()) {

        //Eager loading users with region and roles
        $users = User::with('role', 'region')->where('role_id', 1)->orderBy('created_at', 'DESC')->get();

            return Datatables::of($users)
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Subscribe a customer to a publication
    public function subscribe()
    {
        //Create a subscription

        try {

        $user_id= Auth::user()->id;
        $subscription_id= request('subscription_id');
        $form_duration= request('duration');
        $copies= request('copies');

        if($copies > 10)
        {
            return back()->withError("You cannot subscribe for more than 10 copies per Publication")->withInput();
        }else if($copies < 1){

            return back()->withError("Please select at least one copy from the Publication")->withInput();
        }

        //Check for subscription
        $check_sub = UserSubscription::where('user_id', $user_id)->where('status_id', 1)->where('subscription_id', $subscription_id)
        ->get();

        $check = $check_sub->first();
        //dd($check);
        if($check_sub->isEmpty()){
        
        //Generate random string
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $random = str_shuffle($pin);

        $subscription = Subscription::find($subscription_id);

        //Getting sub object
        $subscription = Subscription::find($subscription_id);
        $time_from = $date = new DateTime('now');
        $time = $date = new DateTime('now');
        $duration = "+".$form_duration." month";
        $status = 1; //Subscribed
        
        //Adding the number of momths to the date based on the selected subscription
        $time_to = $time_from->modify($duration);

        //Saving the subscription
        $user_sub = new UserSubscription();
        $user_sub->user_id = $user_id;
        $user_sub->subscription_id = $subscription_id;
        $user_sub->copies = $copies;
        $user_sub->time_from = $time;
        $user_sub->time_to = $time_to;
        $user_sub->status_id = $status;
        $user_sub->duration = $form_duration;
        $user_sub->save();
        $user_subscription_id = $user_sub->id;

        //Saving the receipt
        $receipt = new Receipt();
        $receipt->user_id = $user_id;
        $receipt->subscription_id = $subscription_id;
        $receipt->order_no = $random;
        $receipt->user_subscription_id = $user_subscription_id;
        $receipt->save();

        return redirect()->back()->with('message', 'You have successfully Subscribed. You can go to view newspaper to view our newspapers');

        }else{
            //sub found
            return redirect()->back()->with('message', 'You have already subscribed to this Publication');
        }

        } catch (Exception $e) {

            return back()->withError("There was a problem with subscription. Contact the Administrator")->withInput();            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function subscriptions()
    {
        try{
        //Display subscriptions per user
        //Getting user id

        $user_id= Auth::user()->id;
        $subscriptions = UserSubscription::where('user_id', $user_id)->where('status_id', 1)
        ->get();

        //dd($subs);

        return view('subscriptions/subscriptions', [
            'subscriptions' => $subscriptions,
        ]);
        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to fetch subscriptions');
        }

    }

    //Displays a view for cancelling comfirmation
    public function cancel(UserSubscription $subscription)
    {
        return view('subscriptions/cancel', [
            'subscription' => $subscription,
        ]);

    }

    //Cancel a subscription
    public function unsubscribe()
    {
        try{
        $subscription_id = request('subscription_id');
        $user_subscription = UserSubscription::find($subscription_id);
        //dd($user_subscription->copies);
        $user_id= Auth::user()->id;
        $user_subscription->where('id', $subscription_id)->where('user_id', $user_id)->update(array('status_id' => 3));
        
        return \Redirect::route('subscriptions.subscriptions')->with('message', 'Subscription cancelled Successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to cancel subscription');
        }
    }

    //Get subscriptions per user
    public function users(User $user)
    {
        try{
        //Display subscriptions per user
        $user_id = $user->id;
        $subscriptions = UserSubscription::where('user_id', $user_id)->where('status_id', 1)
        ->get();

        //dd($subs);

        return view('subscriptions/user', [
            'subscriptions' => $subscriptions,
            'user' => $user,
        ]);

        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to get subscriptions');
        }

    }


    //Get all regions
    public function regions()
    {
        try{
        $regions = Region::all();

        return view('subscriptions/regions', [
            'regions' => $regions,
        ]);

        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to get regions');
        }

    }


    //Get all publications
    public function publications()
    {
    try{
        //Display subscriptions per user
        //Getting user id

        $user_id= Auth::user()->id;
        $subscriptions = UserSubscription::where('user_id', $user_id)->where('status_id', 1)
        ->get();

        //dd($subs);

        return view('subscriptions/publications', [
            'subscriptions' => $subscriptions,
        ]);
        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to fetch publications');
        }

    }


    //Get all regions
    public function newspaper($subscription_id)
    {   
        try{

        //Check subscription
        $user_id= Auth::user()->id;
        $subscriptions = UserSubscription::where('user_id', $user_id)->where('status_id', 1)->where('id', $subscription_id)
        ->get();
        $subs = $subscriptions->first();

        $from = new DateTime(date("Y-m-d H:i:s"));
        $later = new DateTime(date($subs->time_to));
        $abs_diff = $later->diff($from)->format("%a");

        if($abs_diff < 1){

            return redirect()->back()->withError('error', 'This subscription expired. Please subscribe again');
        }        

        return view('subscriptions/newspaper', [
            'subscriptions' => $subs,
        ]);

        } catch (\Exception $e) {
            return redirect()->back()->withError('The subscription has expired.', 'Failed to get newspaper');
        }

    }


    //returns view for subscription history
    public function history()
    {   
        $user_id= Auth::user()->id;
        Session::put('user_id', $user_id);
        return view('subscriptions/history');
    }

    //Getting the history to datatable
    public function gethistory(Request $request)
    {
        $user_id = Session::get('user_id');
        if ($request->ajax()) {

        //Eager loading of subs per user with users, status and subscriptions
        $subscriptions = UserSubscription::with('user', 'subscription', 'status')->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();

            return Datatables::of($subscriptions)
                    ->addIndexColumn()
                    ->make(true);
        }
    }


    //returns view for all subscription history
    public function subscriber_history()
    {   
        return view('subscriptions/admin-history');
    }

    //Getting all the history to datatable
    public function getsubscriberhistory(Request $request)
    {
        if ($request->ajax()) {

        //Eager loading of subs with users, status and subscriptions
        $subscriptions = UserSubscription::with('user', 'subscription', 'status')->orderBy('created_at', 'DESC')->get();

            return Datatables::of($subscriptions)
                    ->addIndexColumn()
                    ->make(true);
        }
    }


    //Generate receipt as PDF
    public function generatereceiptPDF($subscription)
    {
        $user_id= Auth::user()->id;
        $subs = UserSubscription::where('id', $subscription)->where('status_id', 1)->where('user_id', $user_id)
        ->get();
        $sub = $subs->first();

        $receipts = Receipt::where('user_id', $user_id)->where('user_subscription_id', $sub->id)
        ->get();
        $receipt = $receipts->first();
        
        if($sub == null){
            return redirect()->back()->withError('We could not find the subscription.', 'Failed to get subscription');
        }


        //Initializing the receipt placeholders
        $duration = $sub->duration;
        $order_no = $receipt->order_no;
        $date = $receipt->created_at;
        $first_name = $receipt->user->first_name;
        $last_name = $receipt->user->last_name;
        $user_id = $receipt->user->id;
        $region = $receipt->user->region->name;
        $phone = $receipt->user->phone;
        $subscription = $receipt->subscription->name;
        $price = $receipt->subscription->price;

        //Creating an array of the variables
        $data = [
             'order_no'    => $order_no,
             'date'    => $date,
             'first_name'    => $first_name,
             'last_name'    => $last_name,
             'user_id'    => $user_id,
             'region'    => $region,
             'phone'    => $phone,
             'subscription'    => $subscription,
             'price'    => $price,
             'duration'    => $duration,
        ];

        //attaching the array to the PDF element
        $pdf = PDF::loadView('subscriptions/receipt', $data);

        return $pdf->download('receipt.pdf');

    }

    //Returns the view for viewing receipt
    public function viewreceipt($id)
    {
        $receipt = Receipt::where('user_subscription_id', $id)->firstorfail();
        $user_subs = UserSubscription::where('id', $id)->firstorfail();
        $duration = $user_subs->duration;
        $status = $user_subs->status->name;

        return view('subscriptions/view-receipt', ['receipt' => $receipt, 'duration' => $duration, 'status' => $status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionRequest  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
