@extends("admin.layout.master")

@section("title","Edit Commission")

@section("breadcrumb_header","Edit Commission")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Edit Commission</li>
@endsection

@section("content")
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row g-4"> <!--begin::Col-->
                <div class="col-12">

                    <!--begin::Form Validation-->
                    <div class="card  card-outline mb-4"> <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Update Commission</div>
                        </div> <!--end::Header--> <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route("admin.commissions.update", $model->id) }}" novalidate> <!--begin::Body-->
                            @csrf
                            @method("PUT")
                            <div class="card-body"> <!--begin::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12"><label for="restaurant_id"
                                                                  class="form-label">Restaurant</label>
                                        <select name="restaurant_id" class="form-control" id="restaurant_id" required>
                                            <option value="">Select Restaurant</option>
                                            @foreach($restaurants as $restaurant)
                                                <option value="{{ $restaurant->id }}" @selected($model->restaurant_id == $restaurant->id)>
                                                    {{ $restaurant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('restaurant_id')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div> <!--end::Col-->
                                </div> <!--end::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12"><label for="validationCustom02"
                                                                  class="form-label">Paid Amount</label>
                                        <input type="text" name="paid" value="{{ $model->paid }}" class="form-control"
                                               id="validationCustom02" required>
                                        @error('paid')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div> <!--end::Col-->
                                </div> <!--end::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12"><label for="validationCustom03"
                                                                  class="form-label">Commission Date</label>
                                        <input type="date" name="date" value="{{ $model->date }}" class="form-control"
                                               id="validationCustom03" required>
                                        @error('date')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div> <!--end::Col-->
                                </div> <!--end::Row-->
                                <div class="row g-3"> <!--begin::Col-->
                                    <div class="col-md-12"><label for="validationCustom04"
                                                                  class="form-label">Notes</label>
                                        <textarea name="notes" class="form-control" id="validationCustom04">{{ $model->notes }}</textarea>
                                        @error('notes')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div> <!--end::Col-->
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
