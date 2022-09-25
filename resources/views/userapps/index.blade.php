@extends('layouts.app', ['title' => __('User Management')])

@section('content')
<div class="users-list-table">
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
                                <th scope="col">{{ __('Gender') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>
                                    @if ($user->status == 1)
                                    <span class="badge badge-success badge-pill">Active</span>
                                    @elseif ($user->status == 3)
                                    <span class="badge badge-info badge-pill">Unverified</span>
                                    @else
                                    <span class="badge badge-danger badge-pill">Terminated</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="flex">
                                        <a href="{{ route('user.apps.deatil', $user->id) }}"><i class="bx bxs-user-detail"></i>Detail</a>
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
