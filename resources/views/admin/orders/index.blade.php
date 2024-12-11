@extends("admin.layout.master")
@section("title", "Orders")
@section("breadcrumb_header", "Orders")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                            <h3 class="card-title">Orders</h3>
                        </div>
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form id="orderForm" class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="client_name" class="form-label">Client Name</label>
                                        <input type="text" name="client_name" id="client_name" class="form-control"
                                               value="{{ request('client_name') }}" placeholder="Search by client name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="restaurant_name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="restaurant_name" id="restaurant_name" class="form-control"
                                               value="{{ request('restaurant_name') }}" placeholder="Search by restaurant">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="from" class="form-label">From Date</label>
                                        <input type="date" name="from" id="from" class="form-control"
                                               value="{{ request('from') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="to" class="form-label">To Date</label>
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
                            <!-- End Filter Form -->

                            <div id="ordersTable">
                                @include('admin.orders.partials.orders_table', ['data' => $data])
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $data->links('pagination::bootstrap-4') }}
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
            $('#orderForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.orders.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        $('#ordersTable').html(response);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong while fetching orders.');
                    }
                });
            });
        });
    </script>
@endpush
