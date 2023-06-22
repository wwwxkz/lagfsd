@extends('layouts.app')
@section('content')
    <h1>Edit product</h1>
    <div>
        @if ($errors->any())
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach        
            </ul>
        @endif
    </div>
    <form method="post" action="{{route('product.store')}}">
        @csrf
        @method('post')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" value="{{$product->name}}" />
        </div>
        <div>
            <label>Location</label>
            <input type="text" name="location" placeholder="Location" value="{{$product->location}}" />
        </div>
        <div>
            <label>Quantity</label>
            <input type="text" name="quantity" placeholder="Quantity" value="{{$product->quantity}}" />
        </div>
        <div>
            <label>Price</label>
            <input type="text" name="price" placeholder="Price" value="{{$product->price}}" />
        </div>
        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description" value="{{$product->description}}" />
        </div>
        <div>
            <input type="submit" value="Save new product" />
        </div>
    </form>
@endsection