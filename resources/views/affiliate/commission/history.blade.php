@if(\Illuminate\Support\Facades\Auth::guard('affiliate')->user()->parent_id==0)
    <table>
        <thead>
        <td>Recharge Amount</td>
        <td>Commission Amount</td>
        <td>Commission From</td>
        <td>Affiliation Type</td>
        </thead>
        @foreach($data as $history)
            <tbody>
            <td>{{$history->recharge_amount}}</td>
            <td>{{$history->commission_amount}}</td>
            <td>{{$history->user->name}}</td>
            <td>{{($history->user->affiliate->id==\Illuminate\Support\Facades\Auth::guard('affiliate')->user()->id)?'Self':$history->user->affiliate->name}}</td>
            </tbody>
        @endforeach

    </table>
@else
    <table>
        <thead>
        <td>Recharge Amount</td>
        <td>Commission Amount</td>
        <td>Commission From</td>
        </thead>
        @foreach($data as $history)
            <tbody>
            <td>{{$history->recharge_amount}}</td>
            <td>{{$history->commission_amount}}</td>
            <td>{{$history->user->name}}</td>
            </tbody>
        @endforeach

    </table>
@endif


