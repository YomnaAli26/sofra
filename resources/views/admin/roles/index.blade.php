@extends("admin.layout.master")
@section("title","Roles")
@section("breadcrumb_header","Roles")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">roles</li>
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
                            <h3 class="card-title">Roles</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <a class="btn btn-success mb-3" href="{{ route("admin.roles.create") }}">Create
                                Role</a>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $datum)
                                    <tr class="align-middle">
                                        <td>{{$loop->iteration}}.</td>
                                        <td>{{$datum->name}}</td>
                                        <td colspan="3">
                                            <a class="btn btn-primary"
                                               href="{{ route("admin.roles.show",$datum->id) }}">show</a>
                                            <a class="btn btn-info"
                                               href="{{ route("admin.roles.edit",$datum->id) }}">edit</a>
                                            <a class="btn btn-danger"
                                               href="{{ route("admin.roles.destroy",$datum->id) }}"
                                               onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                                                delete
                                            </a>
                                            <form id="delete-form-{{$datum->id}}"
                                                  action="{{ route("admin.roles.destroy",$datum->id)  }}"
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

                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div>
        </div>
    </div>
@endsection
