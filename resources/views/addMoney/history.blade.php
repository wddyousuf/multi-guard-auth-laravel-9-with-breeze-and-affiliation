<table>
    <thead>
    <td>Recharge Amount</td>
    <td>Payment Method</td>
    <td>Transaction Id</td>
    </thead>
@foreach($data as $history)
    <tbody>
    <td>{{$history->recharge_amount}}</td>
    <td>{{$history->payment_method}}</td>
    <td>{{$history->trx_id}}</td>
    </tbody>
@endforeach

</table>
