@extends("admin.layout.master")

@section("title", "Order Details")

@section("breadcrumb_header", "Order Details")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
                            <h3 class="card-title">Order Details</h3>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Client Name:</h5>
                                    <p>{{ $model->client->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Restaurant Name:</h5>
                                    <p>{{ $model->restaurant->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Total Amount:</h5>
                                    <p>{{ number_format($model->total_amount, 2) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Status:</h5>
                                    <p>{{ ucfirst($model->status->value) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Order Date:</h5>
                                    <p>{{ $model->created_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Delivery Address:</h5>
                                    <p>{{ $model->delivery_address }}</p>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h5>Order Items:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($model->meals as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->pivot->quantity }}</td>
                                                <td>{{ number_format($item->pivot->price, 2) }}</td>
                                                <td>{{ number_format($item->pivot->quantity * $item->pivot->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 mt-3">
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
