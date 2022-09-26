@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    <div class="users-list-filter px-1">
        <form>
            <div class="row border rounded py-2 mb-2">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-verified">Verified</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-verified">
                            <option value="">Any</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Role</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-role">
                            <option value="">Any</option>
                            <option value="User">User</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Status</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-status">
                            <option value="">Any</option>
                            <option value="Active">Active</option>
                            <option value="Close">Close</option>
                            <option value="Banned">Banned</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <button type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</button>
                </div>
            </div>
        </form>
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Event') }}</th>
                                    <th scope="col">{{ __('Oragnizer') }}</th>
                                    <th scope="col">{{ __('Sale (Tickets)') }}</th>
                                    <th scope="col">{{ __('Total (Tickets) ') }}</th>
                                    <th scope="col">{{ __('Price (Ticket) ') }}</th>
                                    <th scope="col">{{ __('profit (Admin) ') }}</th>
                                    <th scope="col">{{ __('Event date') }}</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ 'Lorem Ipsum' }}</td>
                                        <td>{{ 'Lorem Ipsum' }}</td>
                                        <td>{{ '59' }}</td>
                                        <td>{{ '300' }}</td>
                                        <td>{{ '$300' }}</td>
                                        <td>{{ '$20' }}</td>
                                        <td>{{ '10 / 2 / 2022' }}</td>
                                        {{-- <td>
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
                                </td> --}}
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
