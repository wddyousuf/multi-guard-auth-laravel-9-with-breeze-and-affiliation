<form name="subAffiliatecreate" enctype="multipart/form-data" method="post" action="{{route('subAffiliateStore')}}">
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
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}">
            @if ($errors->has('name'))
            <span>{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email" value="{{old('email')}}">
            @if ($errors->has('email'))
            <span>{{$errors->first('email')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="password">password</label>
            <input type="password" id="password" name="password" value="{{old('password')}}">
            @if ($errors->has('password'))
            <span>{{$errors->first('password')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="promo_code">Promo Code</label>
            <input type="text" id="promo_code" name="promo_code" value="{{old('promo_code')}}">
            @if ($errors->has('promo_code'))
            <span>{{$errors->first('promo_code')}}</span>
            @endif
        </div>
    <button type="submit">Submit</button>
</form>
