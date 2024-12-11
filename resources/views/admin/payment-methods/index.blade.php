@extends("admin.layout.master")

@section("title","Payment Methods")

@section("breadcrumb_header","Payment Methods")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Payment Methods</li>
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
                            <h3 class="card-title">Payment Methods</h3>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <a class="btn btn-success mb-3" href="{{ route("admin.payment-methods.create") }}">Create Payment Method</a>
                            <div id="clientsTable">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data as $datum)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $datum->name }}</td>
                                            <td>{{ $datum->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                   href="{{ route('admin.payment-methods.show', $datum->id) }}">View</a>
                                                <a class="btn btn-info"
                                                   href="{{ route('admin.payment-methods.edit', $datum->id) }}">Edit</a>
                                                <a class="btn btn-danger"
                                                   href="{{ route('admin.payment-methods.destroy', $datum->id) }}"
                                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{$datum->id}}"
                                                      action="{{ route('admin.payment-methods.destroy', $datum->id) }}"
                                                      method="post" style="display: none;">
                                                    @csrf
                                                    @method("DELETE")
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Payment Methods Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

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
            $(document).querySelectorAll('#toggle').forEach(function (a) {
                a.addEventListener('click',function (e)
                {
                    let clientId = $this.dataset.id;
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route("admin.clients.toggle", ":id") }}".replace(":id", clientId),
                        type: "PATCH"
                    })
                })
            })
            $('#toggle').on('click',function (e) {


            })
        });
    </script>
@endpush
