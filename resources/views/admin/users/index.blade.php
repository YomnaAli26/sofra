@extends("admin.layout.master")

@section("title","Users")

@section("breadcrumb_header","Users")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                            <h3 class="card-title">Users</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-3" id="userForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="user_name" class="form-label">Name</label>
                                        <input type="text" name="name" id="user_name" class="form-control" value="{{ request('name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Filter</button>
                            </form>
                            <!-- End Filter Form -->

                            <a class="btn btn-success mb-3" href="{{ route("admin.users.create") }}">Create User</a>
                            <div id="usersTable">
                                @include("admin.users.partials.users_table", ['data' => $data])
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

            // Handle filter form submission
            $('#userForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.users.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        $('#usersTable').html(response);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong while fetching user data.');
                    }
                });
            });

        });
    </script>
@endpush
