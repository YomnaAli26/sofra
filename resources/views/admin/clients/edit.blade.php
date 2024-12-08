@extends("admin.layout.master")

@section("title","Edit Client")

@section("breadcrumb_header","Clients")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">edit client</li>
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
                            <div class="card-title">Update Client</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.clients.update', $model->id) }}" novalidate>
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

                                    <!-- Phone -->
                                    <div class="col-md-12">
                                        <label for="validationCustom03" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ $model->phone }}" class="form-control" id="validationCustom03" required>
                                        @error('phone')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <!-- Area -->
                                    <div class="col-md-12">
                                        <label for="validationCustom04" class="form-label">Area</label>
                                        <select class="form-control" name="area_id" id="validationCustom04" required>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" @if($area->id == $model->area_id) selected @endif>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

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
