@extends('layouts.master')
@section('title', 'Current Members')

@section('content')
    <div class="container-fluid px-4">
        @if (session('message'))
            <div class="alert alert-success mt-2" id="alertMessage">{{ session('message') }}</div>
        @endif
        <div class="card mt-4">

            <div class="card-header">
                <h4>Current Members
                    <a href="{{ url('admin/invitation-codes/create') }}" class="btn btn-primary btn-sm float-end">Create
                        Invitation Code</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Make Alumni Member</th>
                            @if (Auth::user()->is_super_admin)
                                <th colspan="2">Admin Access</th>
                                <th>Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($currentMembers as $item)
                            @if ($item->is_alumni != 1)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#alumniModal{{ $item->id }}"
                                            class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>
                                    @include('components.bs-modal', [
                                        'id' => 'alumniModal' . $item->id,
                                        'labelId' => 'alumniModalLabel' . $item->id,
                                        'title' => 'Confirm Making Alumni',
                                        'body' => 'Are you sure you want to make this current member an alumni?',
                                        'actionUrl' => 'admin/group/members/current/make-alumni/' . $item->id,
                                        'actionClass' => 'btn btn-warning',
                                        'actionText' => 'Make Alumni Member',
                                    ])
                                    @if (Auth::user()->is_super_admin)
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#adminAddModal{{ $item->id }}"
                                                class="btn btn-primary"><i class="fa fa-plus-circle"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                        @include('components.bs-modal', [
                                            'id' => 'adminAddModal' . $item->id,
                                            'labelId' => 'adminAddModalLabel' . $item->id,
                                            'title' => 'Confirm Giving Admin Access',
                                            'body' =>
                                                'Are you sure you want to make this current member an admin? He can manage the group and its members as an admin.',
                                            'actionUrl' => 'admin/group/members/current/add-admin/' . $item->id,
                                            'actionClass' => 'btn btn-primary',
                                            'actionText' => 'Add Admin',
                                        ])
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#adminRemoveModal{{ $item->id }}"
                                                class="btn btn-secondary"><i class="fa fa-minus-circle"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                        @include('components.bs-modal', [
                                            'id' => 'adminRemoveModal' . $item->id,
                                            'labelId' => 'adminRemoveModalLabel' . $item->id,
                                            'title' => 'Confirm Removing Admin Access',
                                            'body' =>
                                                'Are you sure you want to make this current member an admin? He can manage the group and its members as an admin.',
                                            'actionUrl' => 'admin/group/members/current/remove-admin/' . $item->id,
                                            'actionClass' => 'btn btn-primary',
                                            'actionText' => 'Remove Admin Access',
                                        ])
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"
                                                class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                        @include('components.bs-modal', [
                                            'id' => 'deleteModal' . $item->id,
                                            'labelId' => 'deleteModalLabel' . $item->id,
                                            'title' => 'Confirm Deletion',
                                            'body' => 'Are you sure you want to delete this current member?',
                                            'actionUrl' =>
                                                'admin/group/members/current/delete-member/' . $item->id,
                                            'actionClass' => 'btn btn-danger',
                                            'actionText' => 'Delete',
                                        ])
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h4>Recent Alumni</h4>
                <p>A new alumni profile will be automatically created/deleted for the modification for this section's user.
                    However, all details related to alumni member should be updated in the <a
                        href="/admin/group/members/alumni">'Alumni'</a> section.</p>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Make Current Member</th>
                            @if (Auth::user()->is_super_admin)
                                <th colspan="2">Admin Access</th>
                                <th>Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($currentMembers as $item)
                            @if ($item->is_alumni)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#currentModal{{ $item->id }}"
                                            class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>
                                    @include('components.bs-modal', [
                                        'id' => 'currentModal' . $item->id,
                                        'labelId' => 'currentModalLabel' . $item->id,
                                        'title' => 'Confirm Making Current Member',
                                        'body' =>
                                            'Are you sure you want to make this alumni an current member again?',
                                        'actionUrl' => 'admin/group/members/current/make-current/' . $item->id,
                                        'actionClass' => 'btn btn-success',
                                        'actionText' => 'Make Current Member',
                                    ])
                                    @if (Auth::user()->is_super_admin)
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#adminAddModal{{ $item->id }}"
                                                class="btn btn-primary"><i class="fa fa-plus-circle"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                        @include('components.bs-modal', [
                                            'id' => 'adminAddModal' . $item->id,
                                            'labelId' => 'adminAddModalLabel' . $item->id,
                                            'title' => 'Confirm Giving Admin Access',
                                            'body' =>
                                                'Are you sure you want to make this current member an admin? He can manage the group and its members as an admin.',
                                            'actionUrl' => 'admin/group/members/current/add-admin/' . $item->id,
                                            'actionClass' => 'btn btn-primary',
                                            'actionText' => 'Add Admin',
                                        ])
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#adminRemoveModal{{ $item->id }}"
                                                class="btn btn-secondary"><i class="fa fa-minus-circle"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                        @include('components.bs-modal', [
                                            'id' => 'adminRemoveModal' . $item->id,
                                            'labelId' => 'adminRemoveModalLabel' . $item->id,
                                            'title' => 'Confirm Removing Admin Access',
                                            'body' =>
                                                'Are you sure you want to make this current member an admin? He can manage the group and its members as an admin.',
                                            'actionUrl' => 'admin/group/members/current/remove-admin/' . $item->id,
                                            'actionClass' => 'btn btn-primary',
                                            'actionText' => 'Remove Admin Access',
                                        ])
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"
                                                class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                        @include('components.bs-modal', [
                                            'id' => 'deleteModal' . $item->id,
                                            'labelId' => 'deleteModalLabel' . $item->id,
                                            'title' => 'Confirm Deletion',
                                            'body' => 'Are you sure you want to delete this current member?',
                                            'actionUrl' =>
                                                'admin/group/members/current/delete-member/' . $item->id,
                                            'actionClass' => 'btn btn-danger',
                                            'actionText' => 'Delete',
                                        ])
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Wait for the document to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get the alert element by its ID
            const alertMessage = document.getElementById('alertMessage');

            // Set a timeout to hide the alert after 5 seconds (adjust the time as needed)
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 4000); // 4000 milliseconds = 4 seconds
        });
    </script>
@endsection
