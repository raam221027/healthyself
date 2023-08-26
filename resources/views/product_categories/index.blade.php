@extends('admin.layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List of Product Categories</h1>
        <a href="{{ route('product_categories.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />

    <!-- Check if any success message is present -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
    {{ session()->forget('success') }} <!-- Clear the 'success' message from the session -->
@elseif(session()->has('failed'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('failed') }}
    </div>
    {{ session()->forget('failed') }} <!-- Clear the 'failed' message from the session -->
@endif


    <!-- Check if any products are available -->
    @if($product_categories->count() > 0)
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Product Code</th>
                    <th>Photos</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Details</th>
                    <th>Action</th> <!-- Add class "text-center" for centering -->
                </tr>
            </thead>
            <tbody>
            @foreach ($product_categories as $category)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $product->product_code }}</td>
                        <td class="align-middle">
                            @if($product->photo)
                                <!-- Resize the image to 100x100 pixels -->
                                <img src="{{ asset('storage/' . $product->photo) }}" alt="Product Photo" class="img-thumbnail" style="width: 100px; height: 100px;">             
                            @endif
                        </td>
                        <td class="align-middle">{{ $product->title }}</td>
                        <td class="align-middle">{{ $product->description }}</td>
                        <td class="align-middle">{{ $product->price }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $product->id) }}" type="button" class="btn btn-secondary">Details</a>
                            </div>
                        </td>
                        <td class="align-middle"> <!-- Add class "text-center" for centering -->
                            <!-- Form for enabling or disabling a product -->
                            
                                @if ($product->is_disabled)
                                    <form method="POST" action="{{ route('products.enable', $product->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Click to Enable</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('products.disable', $product->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Click to Disable</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $products->links() }}</div>
    @else
        <p class="text-center">Product not found</p>
    @endif
@endsection

@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
