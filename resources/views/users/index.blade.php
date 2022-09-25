@extends('layouts.app', ['title' => __('User Management')])

@section('content')
<div class="users-list-table">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Users') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <!-- datatable start -->
                <div class="table-responsive">
                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 1)
                                    <span class="badge badge-success badge-pill">Active</span>
                                    @else
                                    <span class="badge badge-danger badge-pill">Terminated</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="flex">
                                        <a href="{{ route('users.edit', $user) }}"><i class="bx bxs-edit-alt"></i>Edit</a>
                                        @if ($user->id != auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                                @csrf
                                                @method('delete')

                                        <button class="transparent-btn"><i class="bx bx-trash" onclick="confirm('Are you sure you want to delete this user?') ? this.parentElement.submit() : ''"></i>Delete</button>
                                    </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                {{ $users->links() }}
            </nav>
        </div>
    </div>
</div>
@endsection
