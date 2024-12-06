@extends("admin.layout.master")

@section("title","Commission Details")

@section("breadcrumb_header","Commission")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Commission</li>
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
                            <h3 class="card-title">Commission Details</h3>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Restaurant Name:</h5>
                                    <p>{{ $model->restaurant->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Paid Amount:</h5>
                                    <p>{{ number_format($model->paid, 2) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Commission Date:</h5>
                                    <p>{{ $model->date }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Notes:</h5>
                                    <p>{{ $model->notes ? $model->notes : 'No notes available' }}</p>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.app-content -->
@endsection
