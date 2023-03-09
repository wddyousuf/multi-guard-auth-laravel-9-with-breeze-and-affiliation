<table>
    <thead>
    <td>Recharge Amount</td>
    <td>User</td>
    <td>Commission</td>
    </thead>
    @foreach($data as $history)
        <tbody>
        <td>{{$history->recharge_amount}}</td>
        <td>{{$history->user->name}}</td>
        <td>
            @foreach($history->commission as $commission)
                {{$commission->affiliate->name}}:{{$commission->commission_amount}}
            @endforeach
        </td>
        </tbody>
    @endforeach

</table>

