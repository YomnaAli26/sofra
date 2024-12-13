@extends("admin.layout.master")

@section("title","Restaurants Data")

@section("breadcrumb_header","Restaurants Data")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">restaurants data</li>
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
                            <h3 class="card-title">Restaurants Data</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin.restaurants.index') }}" class="mb-3" id="restaurantForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="restaurant_name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="name" id="restaurant_name" class="form-control" value="{{ request('restaurant_name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ request('phone') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Filter</button>
                            </form>
                            <!-- End Filter Form -->

                            <a class="btn btn-success mb-3" href="{{ route("admin.restaurants.create") }}">Add Restaurant</a>
                            <div id="restaurantsTable">
                                @include('admin.restaurants.partials.restaurants_table', ['data' => $data])
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
            $('#restaurantForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.restaurants.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        console.log(response)
                        $('#restaurantsTable').html(response);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong while fetching restaurant data.');
                    }
                });
            });
        });

        // Handle toggle button
        $(document).on('click', '#toggle', function (e) {
            e.preventDefault();

            let toggleButton = $(this);
            let restaurantId = toggleButton.data('id');
            let currentStatus = parseInt(toggleButton.data('status'));
            let toggleStatus = currentStatus === 1 ? 0 : 1;

            console.log(`User ID: ${restaurantId}, Current Status: ${currentStatus}, Toggling To: ${toggleStatus}`);

            $.ajax({
                url: "{{ route('admin.restaurants.toggle', ':restaurant') }}".replace(':restaurant', restaurantId),
                type: "PATCH",
                data: JSON.stringify({
                    is_active: toggleStatus
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log('Toggle successful:', response);

                    // Update button data-status
                    toggleButton.data('status', toggleStatus);

                    // Update button text and class
                    if (toggleStatus === 1) {
                        toggleButton.text('Deactivate');
                        toggleButton.removeClass('btn-success').addClass('btn-danger'); // Change to danger style
                    } else {
                        toggleButton.text('Activate');
                        toggleButton.removeClass('btn-danger').addClass('btn-success'); // Change to success style
                    }
                },
                error: function (xhr) {
                    console.error('Error toggling status:', xhr.responseText);
                    alert('Failed to toggle status. Please try again.');
                }
            });
        });
    </script>
@endpush
