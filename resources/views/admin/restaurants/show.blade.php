@extends("admin.layout.master")

@section("title", "Restaurant Details")

@section("breadcrumb_header", "Restaurant")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Restaurant</li>
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
                            <h3 class="card-title">Restaurant Details</h3>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <!-- Restaurant Name -->
                                <div class="col-md-6">
                                    <h5>Restaurant Name:</h5>
                                    <p>{{ $model->name }}</p>
                                </div>

                                <!-- Restaurant Email -->
                                <div class="col-md-6">
                                    <h5>Restaurant Email:</h5>
                                    <p>{{ $model->email }}</p>
                                </div>

                                <!-- Restaurant Phone -->
                                <div class="col-md-6">
                                    <h5>Restaurant Phone:</h5>
                                    <p>{{ $model->phone }}</p>
                                </div>

                                <!-- Password (not shown, but you can add a message like "Password is secure") -->
                                <div class="col-md-6">
                                    <h5>Password:</h5>
                                    <p>Password is secure and not displayed.</p>
                                </div>

                                <!-- Restaurant Area -->
                                <div class="col-md-6">
                                    <h5>Restaurant Area:</h5>
                                    <p>{{ $model->area->name }}</p>
                                </div>

                                <!-- Restaurant Category -->
                                <div class="col-md-6">
                                    <h5>Restaurant Category:</h5>
                                    <p>{{ $model->category->name }}</p>
                                </div>

                                <!-- Restaurant Image -->
                                <div class="col-md-6">
                                    <h5>Restaurant Image:</h5>
                                    <img src="{{ $model->image_path }}" alt="{{ $model->name }}" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                </div>

                                <!-- Minimum Order -->
                                <div class="col-md-6">
                                    <h5>Minimum Order:</h5>
                                    <p>{{ $model->min_order }}</p>
                                </div>

                                <!-- Delivery Fee -->
                                <div class="col-md-6">
                                    <h5>Delivery Fee:</h5>
                                    <p>{{ $model->delivery_fee }}</p>
                                </div>

                                <!-- Restaurant Contact Phone -->
                                <div class="col-md-6">
                                    <h5>Restaurant Contact Phone:</h5>
                                    <p>{{ $model->contact_phone }}</p>
                                </div>

                                <!-- Restaurant WhatsApp Number -->
                                <div class="col-md-6">
                                    <h5>Restaurant WhatsApp:</h5>
                                    <p>{{ $model->whatsapp_number }}</p>
                                </div>

                            </div> <!-- /.row -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.app-content -->
@endsection
