<?php

namespace App\Listeners;

use App\Events\AddedMoney;
use App\Models\Affiliate;
use App\Models\CommissionHistory;
use App\Models\User;
use App\Notifications\CommissionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;

class DistributeCommission
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\AddedMoney $event
     * @return void
     */
    public function handle(AddedMoney $event)
    {
        $recharge_history = $event->recharge_history;
        $user = User::with('affiliate')->find($recharge_history->user_id);
        if ($user->affiliate != null) {
            if ($user->affiliate->parent_id == 0) {
                $commission = CommissionHistory::create([
                    'affiliate_id' => $user->affiliate->id,
                    'user_id' => $user->id,
                    'recharge_amount' => $recharge_history->recharge_amount,
                    'commission_amount' => ($recharge_history->recharge_amount * 30) / 100,
                    'recharge_id' => $recharge_history->id,
                ]);
                Affiliate::where('id', $user->affiliate->id)->update([
                    'current_balance' => $user->affiliate->current_balance + ($recharge_history->recharge_amount * 30) / 100
                ]);
                Notification::send($user->affiliate, new CommissionNotification($commission, $user));
            } else {
                $affiliate_user = Affiliate::find($user->affiliate->parent_id);
                $commission = CommissionHistory::create([
                    'affiliate_id' => $user->affiliate->id,
                    'user_id' => $user->id,
                    'recharge_amount' => $recharge_history->recharge_amount,
                    'commission_amount' => ($recharge_history->recharge_amount * 20) / 100,
                    'recharge_id' => $recharge_history->id,
                ]);
                Affiliate::where('id', $user->affiliate->id)->update([
                    'current_balance' => $user->affiliate->current_balance + ($recharge_history->recharge_amount * 20) / 100
                ]);
                Notification::send($user->affiliate, new CommissionNotification($commission, $user));
                $commissionToParent = CommissionHistory::create([
                    'affiliate_id' => $affiliate_user->id,
                    'user_id' => $user->id,
                    'recharge_amount' => $recharge_history->recharge_amount,
                    'commission_amount' => ($recharge_history->recharge_amount * 10) / 100,
                    'recharge_id' => $recharge_history->id,
                ]);
                Affiliate::where('id', $affiliate_user->id)->update([
                    'current_balance' => $affiliate_user->current_balance + ($recharge_history->recharge_amount * 10) / 100
                ]);
                Notification::send($affiliate_user, new CommissionNotification($commissionToParent, $user));
            }
        }

    }
}
