@extends("admin.layout.master")
@section("title", "Roles")
@section("breadcrumb_header", "Roles")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Roles</li>
@endsection

@section("content")
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row g-4"> <!--begin::Col-->
                <div class="col-12">

                    <!--begin::Form Validation-->
                    <div class="card card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Create Role</div>
                        </div> <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.roles.store') }}" novalidate>
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!--begin::Col for Role Name-->
                                    <div class="col-md-12">
                                        <label for="roleName" class="form-label">Role Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="roleName" required>
                                        @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div> <!--end::Col-->

                                    <!--begin::Col for Permissions-->
                                    <div class="col-md-12">
                                        <label class="form-label">Permissions</label>
                                        <div class="form-check">
                                            @foreach($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="permission-{{ $permission->id }}">
                                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('permissions')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div> <!--end::Col-->
                                </div> <!--end::Row-->
                            </div> <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Create</button>
                            </div> <!--end::Footer-->
                        </form> <!--end::Form-->

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
                        </script> <!--end::JavaScript-->
                    </div> <!--end::Form Validation-->
                </div>
            </div>
        </div>
    </div>
@endsection
