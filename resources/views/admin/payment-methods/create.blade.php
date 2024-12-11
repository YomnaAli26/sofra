@extends("admin.layout.master")
@section("title","Create Payment Method")
@section("breadcrumb_header","Payment Methods")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Create Payment Method</li>
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
                            <div class="card-title">Create Payment Method</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.payment-methods.store') }}" novalidate>
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <label for="paymentMethodName" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                               id="paymentMethodName" required maxlength="255">
                                        @error('name')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <label class="form-label">Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" value="1" id="statusActive" @checked(old('is_active') == 1)>
                                            <label class="form-check-label" for="statusActive">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" value="0" id="statusInactive" @checked(old('is_active') == 0)>
                                            <label class="form-check-label" for="statusInactive">
                                                Inactive
                                            </label>
                                        </div>
                                        @error('is_active')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

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
