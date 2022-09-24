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
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($user->status == 1)
                                    <span class="badge badge-success badge-pill">Active</span>
                                    @else
                                    <span class="badge badge-danger badge-pill">Terminated</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
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
