<?php

namespace App\Http\Controllers;

use App\Events\AddedMoney;
use App\Models\Affiliate;
use App\Models\CommissionHistory;
use App\Models\RechargeHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function adminIndex()
    {
        return view('admin.dashboard');
    }
    public function affiliateIndex()
    {
        return view('affiliate.dashboard');
    }

    public function affiliateCreate()
    {
        return view('admin.affiliate.create');
    }
    public function subAffiliateCreate()
    {
        return view('affiliate.subAffiliate.create');
    }
    function affiliateStore(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'sometimes',
            'email' => 'required|unique:affiliates',
            'promo_code' => 'required|unique:affiliates',
            'password' => 'required',
        ]);
        $data['password']=Hash::make($data['password']);
        try {
            Affiliate::create($data);
            return redirect()->back()->with('success', 'Affiliate created Successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
    }
    function subAffiliateStore(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'sometimes',
            'email' => 'required|unique:affiliates',
            'promo_code' => 'required|unique:affiliates',
            'password' => 'required',
        ]);
        $data['password']=Hash::make($data['password']);
        $data['parent_id']=Auth::guard('affiliate')->user()->id;
        try {
            Affiliate::create($data);
            return redirect()->back()->with('success', 'Affiliate created Successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
    }

    public function addMoney()
    {
        return view('addMoney.create');
    }

    public function storeMoney(Request $request)
    {
        $data = $this->validate($request, [
            'trx_id' => 'required',
            'recharge_amount' => 'required',
            'payment_method' => 'required'
        ]);
        $data['user_id']=Auth::user()->id;
        User::where('id',$data['user_id'])->update([
           'current_balance' => Auth::user()->current_balance+$request->recharge_amount
        ]);
        try {
            $recharge=RechargeHistory::create($data);
            event(new AddedMoney($recharge));
            return redirect()->back()->with('success', 'Recharge created Successfully');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
    }

    public function transection()
    {
        $data=RechargeHistory::where('user_id',Auth::user()->id)->get();
        return view('addMoney.history')->with('data',$data);
    }

    public function commission()
    {
        $data=CommissionHistory::with('user.affiliate')->where('affiliate_id',Auth::guard('affiliate')->user()->id)->get();
        return view('affiliate.commission.history')->with('data',$data);
    }

    public function recharge()
    {
        $data=RechargeHistory::with(['commission.affiliate','user'])->get();
        return view('admin.commission.history')->with('data',$data);
    }
}
