@extends('layouts.app')
@section('content')
    <Example></Example>
    <example></example>
    <example-component></example-component>
    <div id="example"></div>
    <div id="example-component"></div>
    <h1>Create product</h1>
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
            <input type="text" name="name" placeholder="Name" />
        </div>
        <div>
            <label>Location</label>
            <input type="text" name="location" placeholder="Location" />
        </div>
        <div>
            <label>Quantity</label>
            <input type="text" name="quantity" placeholder="Quantity" />
        </div>
        <div>
            <label>Price</label>
            <input type="text" name="price" placeholder="Price" />
        </div>
        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description" />
        </div>
        <div>
            <input type="submit" value="Save new product" />
        </div>
    </form>
@endsection