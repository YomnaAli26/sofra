@extends("admin.layout.master")
@section("title","Cities")
@section("breadcrumb_header","Cities")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">cities</li>
@endsection
@section("content")
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row g-4"> <!--begin::Col-->
                <div class="col-12">

                    <!--begin::Form Validation-->
                    <div class="card  card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Create city</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route("admin.cities.store") }}"
                              novalidate> <!--begin::Body-->
                            @csrf
                            <div class="card-body"> <!--begin::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12"><label for="validationCustom01"
                                                                  class="form-label">Name (English)</label>
                                        <input type="text" name="name[en]" value="{{ old("name.en") }}" class="form-control"
                                               id="validationCustom01" required>
                                        @error('name.en')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div> <!--end::Col--> <!--begin::Col-->
                                </div> <!--end::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12"><label for="validationCustom01"
                                                                  class="form-label">Name (Arabic)</label>
                                        <input type="text" name="name[ar]" value="{{ old("name.ar") }}" class="form-control"
                                               id="validationCustom01" required>
                                        @error('name.ar')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <div class="valid-feedback">Looks good!</div>
                                    </div> <!--end::Col--> <!--begin::Col-->
                                </div> <!--end::Row-->
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Create</button>
                            </div> <!--end::Footer-->
                        </form> <!--end::Form--> <!--begin::JavaScript-->
                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (() => {
                                "use strict";

                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                const forms =
                                    document.querySelectorAll(".needs-validation");

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
