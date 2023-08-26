@extends('admin.layouts.app')

@section('title', 'Assign Roles')

@section('content')
    <h1>Assign Roles for {{ $user->name }}</h1>
    <form method="post" action="{{ route('admin.storeRoles', $user->id) }}">
        @csrf
        <div class="form-check">
            @foreach($roles as $role)
                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" @if($user->hasRole($role->name)) checked @endif>
                <label class="form-check-label" for="{{ $role->name }}">
                    {{ $role->name }}
                </label>
                <br>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save Roles</button>
    </form>
@endsection