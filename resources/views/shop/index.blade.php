@extends('layouts.master')
@section('title','Shopping Cart')
@section('content')

    @if(Session::has('success'))
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div id='charge-message' class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @endif
    
    @foreach ($product->chunk(4) as $chunk)
    <div class="row">
        @foreach ($chunk as $product)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="{{asset($product->imagePath)}}" 
                     alt="Image">
                <div class="caption">
                    <h3>{{$product->title}}</h3>
                    <p class="description">
                        {{$product->description}}
                     </p>
                    <div class="clearfix">
                        <div class="pull-left price">${{$product->price}}</div>
                        <a href="{{route('product.addtocart',['id'=>$product->id])}}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @endforeach

@endsection