<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\User;
use DateTime;
use Auth;

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

    //returns the view for homepage
    public function index()
    {
        //Check for expired subscriptions on successful login
        //Normally this would be a service but its hosted locally
        $today = $date = new DateTime('now');
        $expired_subs = UserSubscription::where('time_to', '<', $today)->get();

        foreach ($expired_subs as $expired_sub) {
           $id = $expired_sub->id;

           //Mark expired
            UserSubscription::where('id', $id)
               ->update([
                   'status_id' => 2 //Expired
                ]);

        }
        $subs = UserSubscription::all();

        //Converting the dates to month number
        $new_date = date_format($today,"Y/m/d H:i:s");
        $current_month = date('m', strtotime($new_date));

        $current_month_count = 0;

        foreach($subs as $sub){
            $date = $sub->time_from;
            $month_num = date('m', strtotime($date));

            if($month_num == $current_month){
                $current_month_count++;
            }
        }

        $user_id= Auth::user()->id;
        $subscriptions = UserSubscription::where('user_id', $user_id)->where('status_id', 1)
        ->get();
        $sub_count = $subscriptions->count();
        $user_count = User::all()->count();
        $total = 0;

        $expired = UserSubscription::where('status_id', 2)->count();
        $active = UserSubscription::where('status_id', 1)->count();

        foreach ($subs as $sub) {
            $total = $sub->subscription->price + $total;
        }

        $all_subs_count = UserSubscription::where('status_id', 1)
        ->count();

        return view('home', [
            'subscriptions' => $subscriptions,
            'sub_count' => $sub_count,
            'user_count' => $user_count,
            'all_subs_count' => $all_subs_count,
            'total' => $total,
            'expired' => $expired,
            'active' => $active,
            'current_month_count' => $current_month_count,
        ]);
    }

    //returns the view for profile
    public function profile()
    {

        $user_id= Auth::user()->id;
        $subscriptions = UserSubscription::where('user_id', $user_id)->where('status_id', 1)
        ->get();

        return view('profile', [
            'subscriptions' => $subscriptions
        ]);

    }
}
