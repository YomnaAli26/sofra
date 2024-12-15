@extends("admin.layout.master")
@section("title","Create User")
@section("breadcrumb_header","Users")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Create User</li>
@endsection

@section("content")
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <div class="col-12">
                    <!--begin::Form Validation-->
                    <div class="card card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Create User</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.users.store') }}" novalidate>
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <label for="userName" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                               id="userName" required>
                                        @error('name')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12">
                                        <label for="userEmail" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                               id="userEmail" required>
                                        @error('email')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-12">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="userPassword"
                                               required>
                                        @error('password')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="roles" class="form-label">role</label>
                                        <select name="role" id="roles" class="form-control" required>
                                            @foreach($roles as $role)
                                                <option name="role" value="{{ $role->name }}">{{ ucwords(str_replace('_',' ',$role->name)) }}</option>
                                            @endforeach

                                        </select>

                                        @error('role')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Create</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Form Validation-->
                </div>
            </div>
        </div>
    </div>
@endsection
