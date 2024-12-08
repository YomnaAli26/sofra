@extends("admin.layout.master")

@section("title","Clients")

@section("breadcrumb_header","Clients")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">clients</li>
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
                            <h3 class="card-title">Clients</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin.clients.index') }}" class="mb-3" id="clientForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="client_name" class="form-label">Client Name</label>
                                        <input type="text" name="name" id="client_name" class="form-control" value="{{ request('name') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ request('phone') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="area" class="form-label">Area</label>
                                        <select name="area_id" id="area" class="form-control">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Filter</button>
                            </form>
                            <!-- End Filter Form -->

                            <a class="btn btn-success mb-3" href="{{ route("admin.clients.create") }}">Create Client</a>
                            <div id="clientsTable">
                                @include("admin.clients.partials.clients_table",['data' => $data])
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
            $('#clientForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.clients.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        $('#clientsTable').html(response);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong while fetching client data.');
                    }
                });
            });
        });
    </script>
@endpush
