@extends("admin.layout.master")
@section("title", "Offers")
@section("breadcrumb_header", "Offers")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Offers</li>
@endsection
@section("content")
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <x-alert type="success"/>
                    <x-alert type="danger"/>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Offers</h3>
                        </div>
                        <div class="card-body">
                            <!--begin::Filter Form-->
                            <form id="offerForm" class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Offer Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ request('name') }}" placeholder="Search by name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="description" class="form-label">Offer Description</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                               value="{{ request('description') }}" placeholder="Search by description">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="restaurant" class="form-label">Restaurant</label>
                                        <input type="text" name="restaurant-name" id="restaurant" class="form-control"
                                               value="{{ request('restaurant-name') }}" placeholder="Search by restaurant">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="from" class="form-label">Start Date</label>
                                        <input type="date" name="from" id="from" class="form-control"
                                               value="{{ request('from') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="to" class="form-label">End Date</label>
                                        <input type="date" name="to" id="to" class="form-control"
                                               value="{{ request('to') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100 mt-4">
                                            <i class="fas fa-filter"></i> Apply Filters
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Filter Form-->

                            <div id="offersTable">
                                @include('admin.offers.partials.offers_table', ['data' => $data])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#offerForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.offers.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        $('#offersTable').html(response);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong while fetching offers.');
                    }
                });
            });
        });
    </script>
@endpush
