@extends("admin.layout.master")

@section("title","Edit User")

@section("breadcrumb_header","Users")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">edit user</li>
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
                            <div class="card-title">Update User</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.users.update', $model->id) }}" novalidate>
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ $model->name }}" class="form-control" id="validationCustom01" required>
                                        @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12">
                                        <label for="validationCustom02" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ $model->email }}" class="form-control" id="validationCustom02" required>
                                        @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                <!--end::Row-->
                            </div>

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->

                        <!--begin::JavaScript-->
                        <script>
                            (() => {
                                "use strict";

                                // Fetch all forms to apply Bootstrap validation styles
                                const forms = document.querySelectorAll(".needs-validation");

                                Array.from(forms).forEach((form) => {
                                    form.addEventListener("submit", (event) => {
                                        if (!form.checkValidity()) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add("was-validated");
                                    }, false);
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
