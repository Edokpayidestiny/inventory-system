<x-layout>
    <x-navbar></x-navbar>

    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                 <div class="page-title">
                    <h4>User List</h4>
                    <h6>Manage your User</h6>
                </div>

            </div>

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>User name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a class="me-3" href="{{ route('admin.users.edit', $user->uuid) }}">
                                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layout>


