@extends("admin.layout.master")
@section("title","Create Client")
@section("breadcrumb_header","Clients")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Create Client</li>
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
                            <div class="card-title">Create Client</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.clients.store') }}" novalidate>
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <label for="clientName" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                               id="clientName" required>
                                        @error('name')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12">
                                        <label for="clientEmail" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                               id="clientEmail" required>
                                        @error('email')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-12">
                                        <label for="clientPhone" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                               id="clientPhone" required minlength="11" maxlength="11">
                                        @error('phone')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-12">
                                        <label for="clientPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="clientPassword"
                                               required>
                                        @error('password')
                                        <div class="error-message text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Area Dropdown -->
                                    <div class="col-md-12">
                                        <label for="clientArea" class="form-label">Area</label>
                                        <select class="form-control" name="area_id" id="clientArea" required>
                                            <option value="" selected disabled>-- Select Area --</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
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
