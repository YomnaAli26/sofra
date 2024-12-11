{{-- resources/views/admin/payment_methods/edit.blade.php --}}
@extends("admin.layout.master")
@section("title", "Edit Payment Method")
@section("breadcrumb_header", "Payment Methods")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Edit Payment Method</li>
@endsection

@section("content")
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Payment Method</div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.payment-methods.update', $model->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Payment Method Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $model->name }}" required>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Status</label><br>
                                    <input type="radio" name="is_active" value="1" @checked($model->is_active )> Active
                                    <input type="radio" name="is_active" value="0" @checked(!$model->is_active)> Inactive
                                    @error('is_active')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
