@extends("admin.layout.master")

@section("title","Restaurants Payments")

@section("breadcrumb_header","Restaurants Payments")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">restaurants payments</li>
@endsection

@section("content")
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <x-alert type="success"/>
                    <x-alert type="danger"/>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Restaurants Payments</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin.commissions.index') }}" class="mb-3" id="offerForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="restaurant_name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="restaurant-name" id="restaurant_name" class="form-control" value="{{ request('restaurant_name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="paid" class="form-label">Paid</label>
                                        <input type="number" step="0.01" name="paid" id="paid" class="form-control" value="{{ request('paid') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Filter</button>
                            </form>
                            <!-- End Filter Form -->

                            <a class="btn btn-success mb-3" href="{{ route("admin.commissions.create") }}">Create</a>
                            <div id="offersTable">
                                @include('admin.commissions.partials.commissions_table', ['data' => $data])
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
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
                    url: "{{ route('admin.commissions.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        console.log(response)
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
