@extends('admin.layouts.app')

@section('contents')
<style>
    /* Custom CSS to center the content */
    .center-content {
        margin-top: 50px;
        margin-left: 50%; /* Add padding to avoid overlap with the sidebar */
    }
</style>

    <div class="d-flex align-items-center justify-content-between" style="margin-left: 16%;">
    <i><span style="color: #a4f05c; font-weight: 800; font-size:38px;">List of Products</i>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">Add Product</button>
    </div>

    <!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                </div>
                                <div class="col">
                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description"></textarea>
                            </div>
                            <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
                        </form>
      </div>
     
    </div>
  </div>
</div>

    <!-- Check if any success message is present -->
    @if (session()->has('success'))
        <div class="alert alert-success" style="margin-left: 16%; width:85.5%;" role="alert">
            {{ session()->get('success') }}
        </div>
        {{ session()->forget('success') }} <!-- Clear the 'success' message from the session -->
    @elseif(session()->has('failed'))
        <div class="alert alert-danger" style="margin-left: 16%; width:85.5%;" role="alert">
            {{ session()->get('failed') }}
        </div>
        {{ session()->forget('failed') }} <!-- Clear the 'failed' message from the session -->
    @endif


    <!-- Check if any products are available -->
    @if ($products->count() > 0)
        <table class="table" style="margin-left: 16%; width:90%;">
            <thead class="table-success table-bordered">
                <tr>
                    <th>#</th>
                    <th>Product Code</th>
                    <th>Photos</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    {{-- <th>Edit</th>
                    <th>Details</th> --}}
                    <th>Action</th> <!-- Add class "text-center" for centering -->
                </tr>
            </thead>
            <tbody class="table">
                @foreach ($products as $product)
                    <tr>
                    <td class="align-middle">{{ $loop->iteration + ($products->perPage() * ($products->currentPage() - 1)) }}</td>

                        <td class="align-middle">{{ $product->product_code }}</td>
                        <td class="align-middle">
                            @if ($product->photo)
                                <!-- Resize the image to 100x100 pixels -->
                                <img src="{{ asset($product->photo) }}" alt="Product Photo"
                                    class="img-thumbnail" style="width: 100px; height: 100px;">
                            @endif
                        </td>
                        <td class="align-middle">{{ $product->title }}</td>
                        <td class="align-middle">{{ $product->description }}</td>
                        <td class="align-middle">₱{{ $product->price }}.00</td>

                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}"
                                    type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-bs-toggle="modal"
                                                data-bs-target="#showDetailsModal{{ route('products.show', $product->id) }}"
                                                type="button" class="btn btn-primary"><i class="bi bi-eye-fill"></i></button>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if ($product->is_disabled)
                                                            <form method="POST" action="{{ route('products.enable', $product->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger"><i
                                                                        class="bi bi-toggle-off"></i></button>
                                                            </form>
                                                        @else
                                                            <form method="POST" action="{{ route('products.disable', $product->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-primary"><i
                                                                        class="bi bi-toggle-on"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    {{-- </div> --}}
                        </td>

                        <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('products.update', $product->id) }}" method="POST">

                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" name="title" class="form-control"
                                                        placeholder="Title" value="{{ $product->title }}">
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="text" name="price" class="form-control"
                                                        placeholder="Price" value="{{ $product->price }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label class="form-label">Product Code</label>
                                                    <input type="text" name="product_code" class="form-control"
                                                        placeholder="Product Code" value="{{ $product->product_code }}"
                                                        readonly>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" placeholder="Descriptoin">{{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="width: 100%; margin-right: 55%;">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </td>

                                    <div class="modal fade" id="showDetailsModal{{ route('products.show', $product->id) }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Product Details</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <h1 class="mb-0">Detail Product</h1> -->
                                                <!-- <hr /> -->
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label class="form-label">Product Name</label>
                                                        <input type="text" name="title" class="form-control"
                                                            placeholder="Title" value="{{ $product->title }}" readonly>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label">Price</label>
                                                        <input type="text" name="price" class="form-control"
                                                            placeholder="Price" value="{{ $product->price }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label class="form-label">Product Code</label>
                                                        <input type="text" name="product_code" class="form-control"
                                                            placeholder="Product Code"
                                                            value="{{ $product->product_code }}" readonly>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" placeholder="Descriptoin" readonly>{{ $product->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                                            </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination" style="margin-left:80%;">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($products->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($products->getUrlRange(max(1, $products->currentPage() - 1), min($products->lastPage(), $products->currentPage() + 1)) as $page => $url)
            <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        @if ($products->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</div>

    @else
        <p class="text-center">Product not found</p>
    @endif
@endsection

@section('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection
