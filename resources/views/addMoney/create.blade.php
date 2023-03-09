<form name="subAffiliatecreate" enctype="multipart/form-data" method="post" action="{{route('storeMoney')}}">
    @csrf
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
        <div class="form-group">
            <label for="recharge_amount">Recharge Amount</label>
            <input type="number" id="recharge_amount" name="recharge_amount" placeholder="ex: BDT-50" value="{{old('recharge_amount')}}">
            @if ($errors->has('recharge_amount'))
            <span>{{$errors->first('recharge_amount')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method">
                <option value="bkash">Bkash</option>
                <option value="nagad">Nagad</option>
            </select>
            @if ($errors->has('payment_method'))
            <span>{{$errors->first('payment_method')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="trx_id">Transaction ID</label>
            <input type="text" id="trx_id" name="trx_id" value="{{old('trx_id')}}">
            @if ($errors->has('trx_id'))
            <span>{{$errors->first('trx_id')}}</span>
            @endif
        </div>
    <button type="submit">Submit</button>
</form>
