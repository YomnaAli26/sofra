@extends("admin.layout.master")

@section("title","Clients")

@section("breadcrumb_header","Clients")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">client details</li>
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
                            <h3 class="card-title">Client Details</h3>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <!-- Client Name -->
                                <div class="col-md-6">
                                    <h5>Name:</h5>
                                    <p>{{ $model->name }}</p>
                                </div>

                                <!-- Client Email -->
                                <div class="col-md-6">
                                    <h5>Email:</h5>
                                    <p>{{ $model->email }}</p>
                                </div>

                                <!-- Client Phone -->
                                <div class="col-md-6">
                                    <h5>Phone:</h5>
                                    <p>{{ $model->phone }}</p>
                                </div>

                                <!-- Client Area (Arabic) -->
                                <div class="col-md-6">
                                    <h5>Area (Arabic):</h5>
                                    <p>{{ $model->area->getTranslation('name', 'ar') }}</p>
                                </div>

                                <!-- Client Area (English) -->
                                <div class="col-md-6">
                                    <h5>Area (English):</h5>
                                    <p>{{ $model->area->getTranslation('name', 'en') }}</p>
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
