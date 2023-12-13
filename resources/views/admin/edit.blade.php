@extends('admin.layouts.app')
@section('contents')
<div class="d-flex justify-content-center">
<div class="col-md-6">
<div class="col-md-15">
<i><span style="color: #a4f05c; font-weight: 800; font-size:35px;">Edit User</i>
    <hr />
    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" value="{{ $user->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input name="email" value="{{ $user->email }}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Repeat Password</label>
                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Repeat Password">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
         <div class="col-md-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="Cashier" {{ $user->hasRole('Cashier') ? 'selected' : '' }}>Cashier</option>
                <option value="Kitchen" {{ $user->hasRole('Kitchen') ? 'selected' : '' }}>Kitchen</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

</div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Update</button>
        </div>
    </form>
    </div>
</div>
</div>
@endsection




