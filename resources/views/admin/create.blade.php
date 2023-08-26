@extends('admin.layouts.app')
  
@section('title', '')
  
@section('contents')

<div class="d-flex justify-content-center">
<div class="col-md-6">
<div class="col-md-15">
    <h1 class="mb-0">Create Staff Account</h1>
    <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="Cashier">Cashier</option>
                <option value="Kitchen">Kitchen</option>
            </select>
            </div>
                <div class="form-group">
                    <input name="name" type="text" class="form-control form-control-user @error('name')is-invalid @enderror" id="exampleInputName" placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input name="email" type="email" class="form-control form-control-user @error('email')is-invalid @enderror" id="exampleInputEmail" placeholder="Email Address">
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="col-sm-6">
                    <input name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation')is-invalid @enderror" id="exampleRepeatPassword" placeholder="Repeat Password">
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    </div>
                    

                </div>
                <input type="submit" class="btn btn-primary btn-lg2 ms-2" value="Create">
                </div>
                </div>
                </div>
                
                </form>
@endsection