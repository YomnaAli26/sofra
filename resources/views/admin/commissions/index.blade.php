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
                            <a class="btn btn-success mb-3" href="{{ route("admin.restaurant-payments.create") }}">Create
                                Category</a>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Restaurant Name</th>
                                    <th>Paid</th>
                                    <th>Notes</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $datum)
                                    <tr class="align-middle">
                                        <td>{{$loop->iteration}}.</td>
                                        <td>{{$datum->restaurant?->name}}</td>
                                        <td>{{$datum->paid}}</td>
                                        <td>{{$datum->notes}}</td>
                                        <td>{{$datum->date}}</td>
                                        <td colspan="3">
                                            <a class="btn btn-primary"
                                               href="{{ route("admin.restaurant-payments.show",$datum->id) }}">show</a>
                                            <a class="btn btn-info"
                                               href="{{ route("admin.restaurant-payments.edit",$datum->id) }}">edit</a>
                                            <a class="btn btn-danger"
                                               href="{{ route("admin.restaurant-payments.destroy",$datum->id) }}"
                                               onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                                                delete
                                            </a>
                                            <form id="delete-form-{{$datum->id}}"
                                                  action="{{ route("admin.restaurant-payments.destroy",$datum->id)  }}"
                                                  method="post" style="display: none;">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="align-middle">
                                        <td colspan="2">No Data Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
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
