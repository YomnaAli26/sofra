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
                                        <input type="text" name="client-name" id="client_name" class="form-control"
                                               value="{{ request('client-name') }}" placeholder="Search by client name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="restaurant-name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="restaurant-name" id="restaurant-name" class="form-control"
                                               value="{{ request('restaurant-name') }}" placeholder="Search by restaurant">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="restaurant-name" class="form-label">Total</label>
                                        <input type="text" name="total_amount" id="total_amount" class="form-control"
                                               value="{{ request('total_amount') }}" placeholder="Search by total">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="from" class="form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">__Select Status__</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->value }}">{{ ucfirst($status->name) }}</option>
                                            @endforeach
                                        </select>
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
