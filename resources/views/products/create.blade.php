@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('contents')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0">Add Product</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Product Name</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                </div>
                                <div class="col">
                                    <label for="photo" class="form-label">Product Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description"></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
