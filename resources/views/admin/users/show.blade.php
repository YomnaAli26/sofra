@extends("admin.layout.master")

@section("title","Users")

@section("breadcrumb_header","Users")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">user details</li>
@endsection

@section("content")
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <!-- User Name -->
                                <div class="col-md-6">
                                    <h5>Name:</h5>
                                    <p>{{ $model->name }}</p>
                                </div>

                                <!-- User Email -->
                                <div class="col-md-6">
                                    <h5>Email:</h5>
                                    <p>{{ $model->email }}</p>
                                </div>

                                <!-- Account Created -->
                                <div class="col-md-6">
                                    <h5>Account Created:</h5>
                                    <p>{{ $model->created_at->format('d M Y, h:i A') }}</p>
                                </div>

                                <!-- Last Update -->
                                <div class="col-md-6">
                                    <h5>Last Updated:</h5>
                                    <p>{{ $model->updated_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.app-content -->
@endsection
