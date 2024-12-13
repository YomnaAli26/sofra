@extends("admin.layout.master")
@section("title","Users")
@section("breadcrumb_header","Users")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@section("content")
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Form Validation-->
                    <div class="card card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Change Password</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.users.change-password.update') }}"
                              enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('patch')

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!-- Current Password -->
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">{{ __('Current Password') }}</label>
                                        <input type="password" name="current_password" class="form-control" id="validationCustom01" required>

                                        <!-- Display error for current_password -->
                                        @if ($errors->has('current_password'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('current_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Col-->

                                    <!-- New Password -->
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">{{ __('New Password') }}</label>
                                        <input type="password" name="password" class="form-control" id="validationCustom01" required>

                                        <!-- Display error for password -->
                                        @if ($errors->has('password'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Col-->

                                    <!-- Confirm Password -->
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">{{ __('Confirm Password') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="validationCustom01" required>

                                        <!-- Display error for password_confirmation -->
                                        @if ($errors->has('password_confirmation'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Change</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->

                        <!--begin::JavaScript-->
                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (() => {
                                "use strict";

                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                const forms = document.querySelectorAll(".needs-validation");

                                // Loop over them and prevent submission
                                Array.from(forms).forEach((form) => {
                                    form.addEventListener(
                                        "submit",
                                        (event) => {
                                            if (!form.checkValidity()) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }

                                            form.classList.add("was-validated");
                                        },
                                        false
                                    );
                                });
                            })();
                        </script>
                        <!--end::JavaScript-->
                    </div>
                    <!--end::Form Validation-->
                </div>
            </div>
        </div>
    </div>
@endsection
