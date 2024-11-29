@extends("admin.layout.master")

@section("title","Areas")

@section("breadcrumb_header","Areas")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">areas</li>
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
                            <h3 class="card-title">Details</h3>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Name: (Arabic)</h5>
                                    <p> {{$model->getTranslation('name','ar')}} </p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Name: (English)</h5>
                                    <p> {{$model->getTranslation('name','en')}} </p>
                                </div>
                                <div class="col-md-6">
                                    <h5>City Name: (Arabic)</h5>
                                    <p>{{$model->city->getTranslation('name','ar')}}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>City Name: (English)</h5>
                                    <p>{{$model->city->getTranslation('name','en')}}</p>
                                </div>
                            </div> <!-- /.row -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.app-content -->
@endsection
