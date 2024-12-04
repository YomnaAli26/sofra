@extends("admin.layout.master")
@section("title","Settings")
@section("breadcrumb_header","Settings")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">settings</li>
@endsection
@section("content")
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row g-4"> <!--begin::Col-->
                <div class="col-12">

                    <!--begin::Form Validation-->
                    <div class="card  card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Update settings</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route("admin.settings.update") }}"
                              novalidate> <!--begin::Body-->
                            @csrf
                            @method("PUT")
                            <div class="card-body"> <!--begin::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12">
                                        @foreach(settings() as $key => $value)
                                            <label for="validationCustom01" class="form-label">
                                                {{ Str::title(str_replace('_', ' ', $key)) }}
                                            </label>
                                            <input type="text" name="{{ $key }}" value="{{ $value }}" class="form-control"
                                               id="validationCustom01" required>
                                        @error("{{$key}}")
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                            <br>
                                        @endforeach
                                        <div class="valid-feedback">Looks good!</div>
                                    </div> <!--end::Col--> <!--begin::Col-->

                                    </div> <!--end::Col--> <!--begin::Col-->
                                </div> <!--end::Row-->
                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Update</button>
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
