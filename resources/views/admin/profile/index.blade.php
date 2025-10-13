<x-layout>
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Profile</h4>
                    <h6>User Profile</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="profile-set">
                        <div class="profile-head">
                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    <img src="{{ asset('assets/img/customer/customer5.jpg') }}" alt="img"
                                        id="blah">
                                    <div class="profileupload">
                                        <input type="file" id="imgInp">
                                        <a href="javascript:void(0);">
                                            <img src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-contentname">
                                    <h2>{{ $user->name }}</h2>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layout>
