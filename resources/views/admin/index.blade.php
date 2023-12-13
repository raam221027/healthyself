@extends('admin.layouts.app')

@section('title', '')

@section('contents')
    <div class="d-flex align-items-center justify-content-between" style="margin-left: 18%;">
    <i><span style="color: #a4f05c; font-weight: 800; font-size:38px;">List of Users</i>
    <button type="button"class="btn btn-primary" style=" margin-right:5%;" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Create Staff's Account
    </button>
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
                    <select name="role" id="role" class="form-control" required>
                        <label>Choose Roles</label>
                        <option value="role">Choose Roles</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Kitchen">Kitchen</option>
                    </select>
            </div>
                <div class="form-group">
                    <input name="name" type="text" class="form-control form-control-user  @error('name')is-invalid @enderror" id="exampleInputName" placeholder="Name">
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
                    <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
                </div>
                </div>

                
                </form>
      </div>
    </div>
  </div>
  
    <hr />
    @if(session()->has('success'))
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
    <table class="table table-bordered table-hover" style="margin-left: 18%; width:80%;">
        <thead class="table-success table-bordered">
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Action</th>
            </tr>
        </thead>
        @if($users->count() > 0)
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2-{{ $user->id }}">Edit</button>
                    <div class="modal fade" id="exampleModal2-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('admin.update', $user->id) }}" method="POST" id="updateForm-{{ $user->id }}">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" value="{{ $user->name }}" type="text" class="form-control form-field @error('name') is-invalid @enderror" id="name" placeholder="Name">
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
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
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
<div class="modal-footer">
<button type="button" class="btn btn-primary" id="updateButton-{{ $user->id }}" onclick="submitForm('{{ $user->id }}')">Update</button>
        </div>
</div>
 
</form>
                    
                        <td>
                                @if ($user->is_disabled)
                                    <form method="POST" action="{{ route('admin.enable', $user->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger"><i
                                                                        class="bi bi-toggle-off"></i></button>
                                                            </form>
                                                        @else
                                                            <form method="POST" action="{{ route('admin.disable', $user->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-primary"><i
                                                                        class="bi bi-toggle-on"></i></button>
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
    <div class="pagination" style="margin-left:80%;">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($users->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($users->getUrlRange(max(1, $users->currentPage() - 1), min($users->lastPage(), $users->currentPage() + 1)) as $page => $url)
            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        @if ($users->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('updateButton').addEventListener('click', function () {
        // Show the SweetAlert confirmation dialog
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                Swal.fire({
                    title: 'Changes are successfully saved!',
                    icon: 'success',
                    timer: 2000, // Adjust the duration (in milliseconds) as needed
                    showConfirmButton: false, // Hide the "OK" button
                });
                setTimeout(function () {
                    document.getElementById('updateForm').submit();
                }, 2000); // Adjust the timer to match the timer in Swal.fire
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
            }
        });
    });
</script>

<script>
    function submitForm(userId) {
        // Show the SweetAlert confirmation dialog
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                Swal.fire({
                    title: 'Changes are successfully saved!',
                    icon: 'success',
                    timer: 2000, // Adjust the duration (in milliseconds) as needed
                    showConfirmButton: false, // Hide the "OK" button
                });
                setTimeout(function () {
                    document.getElementById('updateForm-' + userId).submit();
                }, 2000); // Adjust the timer to match the timer in Swal.fire
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
            }
        });
    }
</script>

@endsection




