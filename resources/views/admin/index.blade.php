@extends('admin.layouts.app')

@section('title', '')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List of Users</h1>
        <!-- <a href="{{ route('admin.create') }}" class="btn btn-primary">Create Staff's Account</a> -->
        <!-- Button trigger modal -->
    <button type="button"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Create Staff's Account
    </button>
    <!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option><i class="ri-outlet-2-fill"></i></option>
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
                    <div class="form-group">
                    <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                    <input name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation')is-invalid @enderror" id="exampleRepeatPassword" placeholder="Repeat Password">
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    </div>
                <input type="submit" class="btn btn-primary btn-lg2 ms-2" value="Create">
                </div>
                </div>

                
                </form>
      </div>
    </div>
  </div>


    <hr />
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
    <table class="table">
        <thead class="table-primary">
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($users->count() > 0)
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>   
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('admin.edit', $user->id) }}" type="button" class="btn btn-warning">Edit</a>
                        <td>
                                @if ($user->is_disabled)
                                    <form action="{{ route('admin.enable', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Use PUT method for enabling the user -->
                                        <button type="submit" class="btn btn-primary">Click to Enable</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.disable', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Use DELETE method for disabling the user -->
                                        <button type="submit" class="btn btn-danger">Click to Disable</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Users not found</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div>{{ $users->links() }}</div>
@endsection
