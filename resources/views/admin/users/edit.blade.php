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

                    <form action="{{ route('admin.users.update', $user->uuid) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-submit me-2">Update User</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>





</x-layout>
