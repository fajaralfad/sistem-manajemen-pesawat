@extends('layouts.app')

@section('title', 'Admin Teknisi')
@section('navbar')
    @include('layouts.navbar-admin')
@endsection

@section('content')
<div class="d-flex">
    <div class="content w-100">
        <div class="container mt-4">
            <h2>Manage Users</h2>
            <hr>
            <!-- Button to open the Add User modal -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal"><i data-feather="plus-circle"></i> Add User</button>

            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- User table -->
            <table id="usersTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <!-- Edit button triggers modal and fills it with user data -->
                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>


                                <!-- Delete form -->
                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Create User Modal -->
        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="createUserForm" method="POST" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createUserModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Name field -->
                            <div class="form-group">
                                <label for="createName">Name</label>
                                <input type="text" class="form-control" id="createName" name="name" required>
                            </div>

                            <!-- Email field -->
                            <div class="form-group">
                                <label for="createEmail">Email</label>
                                <input type="email" class="form-control" id="createEmail" name="email" required>
                            </div>

                            <!-- Role dropdown -->
                            <div class="form-group">
                                <label for="createRole">Role</label>
                                <select class="form-control" id="createRole" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="teknisi">Teknisi</option>
                                </select>
                            </div>

                            <!-- Password field -->
                            <div class="form-group">
                                <label for="createPassword">Password</label>
                                <input type="password" class="form-control" id="createPassword" name="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editRole">Role</label>
                            <select class="form-control" id="editRole" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="teknisi">Teknisi</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <script>
            // Function to open the edit modal and populate it with user data
            function openEditModal(user) {
                const form = document.getElementById('editUserForm');
                form.action = `/admin/users/${user.id}`;
                form.querySelector('#editName').value = user.name;
                form.querySelector('#editEmail').value = user.email;
                form.querySelector('#editRole').value = user.role;

                const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                modal.show();
            }

            // Initialize DataTable
            $(document).ready(function() {
                $('#usersTable').DataTable();
            });
        </script>
        
    </div>
</div>
@endsection