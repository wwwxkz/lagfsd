@extends('layouts.app')
@section('content')
    <h1>Product</h1>
    <a href="{{ route('product.create') }}">Create product</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->location}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td><a href="{{route('product.edit', ['product' => $product])}}">Edit</a></td>
                <td>
                    <form method="post" action="{{route('product.delete', ['product' => $product])}}">
                    @csrf
                    @method('delete')
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection