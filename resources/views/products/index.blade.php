@extends('layouts.app')
@section('content')
    <head>
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="card">
        <h5 class="card-header">Products</h5>
        <div class="card-body">
            <div class="row justify-content-between">
                <a class="card-title w-auto" href="{{ route('product.create') }}">Create product</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <th>{{$product->name}}</th>
                            <td>{{$product->location}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                            <td><a href="{{route('product.edit', ['product' => $product])}}">Edit</a></td>
                            <td>
                                <form method="post" action="{{route('product.delete', ['product' => $product])}}">
                                @csrf
                                @method('delete')
                                    <input 
                                        style="
                                            all: unset; 
                                            color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1)); 
                                            text-decoration: underline; 
                                            cursor: pointer;" 
                                        type="submit" 
                                        value="Delete" 
                                    />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection