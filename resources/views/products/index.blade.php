@extends('admin.layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List of Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
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
    @if($products->count() > 0)
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Product Code</th>
                    <th>Photos</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Details</th>
                    <th>Action</th> <!-- Add class "text-center" for centering -->
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
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
                        <td class="align-middle">₱{{ $product->price }}.00</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}" type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->title }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Code</label>
                <input type="text" name="product_code" class="form-control" placeholder="Product Code" value="{{ $product->product_code }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Descriptoin" >{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-bs-toggle="modal" data-bs-target="#showDetailsModal{{ route('products.show', $product->id) }}" type="button" class="btn btn-primary"><i class="bi bi-eye-fill"></i></button>
                                <div class="modal fade" id="showDetailsModal{{ route('products.show', $product->id) }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Product Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- <h1 class="mb-0">Detail Product</h1> -->
    <!-- <hr /> -->
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->title }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Product Code</label>
            <input type="text" name="product_code" class="form-control" placeholder="Product Code" value="{{ $product->product_code }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" placeholder="Descriptoin" readonly>{{ $product->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div> -->
    </div>
      </div>
      
    </div>
  </div>
</div>
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
