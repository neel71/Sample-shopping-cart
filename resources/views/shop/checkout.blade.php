@extends('layouts.master')
@section('title','Shopping Cart')
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
        <h1>Checkout</h1>
        <h4>Your Total: ${{ $total }}</h4>
        <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ' ' }}">
            {{Session::get('error')}}
        </div>
        <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <input id="Address" name='address' type="text" class="form-control" required>
                    </div>
                </div>
                <hr/>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-name">Card Holder Name</label>
                        <input id="card-name" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-number">Credit Card Number</label>
                        <input id="card-number" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="card-expiry-month">Expiration Month</label>
                                <input id="card-expiry-month" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="card-expiry-year">Expiration Year</label>
                                <input id="card-expiry-year" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-cvc">CVC</label>
                        <input id="card-cvc" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Buy Now</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{URL::to('src/js/checkout.js')}}"></script>
@endsection