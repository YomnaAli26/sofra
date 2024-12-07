@extends("admin.layout.master")

@section("title", "Edit Restaurant")

@section("breadcrumb_header", "Edit Restaurant")

@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Edit Restaurant</li>
@endsection

@section("content")
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Form Validation-->
                    <div class="card card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Update Restaurant</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form class="needs-validation" method="post" action="{{ route('admin.restaurants.update', $model->id) }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <!-- Restaurant Name -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="name" value="{{ old('name', $model->name) }}" class="form-control" id="name" required>
                                        @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Restaurant Email -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Restaurant Email</label>
                                        <input type="email" name="email" value="{{ old('email', $model->email) }}" class="form-control" id="email" required>
                                        @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Restaurant Phone -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="phone" class="form-label">Restaurant Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone', $model->phone) }}" class="form-control" id="phone" required>
                                        @error('phone')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Area Selection -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="area_id" class="form-label">Restaurant Area</label>
                                        <select name="area_id" class="form-control" id="area_id" required>
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" @selected(old('area_id', $model->area_id) == $area->id)>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Category Selection -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="category_id" class="form-label">Restaurant Category</label>
                                        <select name="category_id" class="form-control" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', $model->category_id) == $category->id)>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Restaurant Image -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">Restaurant Image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        @error('image')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Minimum Order -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="min_order" class="form-label">Minimum Order</label>
                                        <input type="number" name="min_order" value="{{ old('min_order', $model->min_order) }}" class="form-control" id="min_order" required>
                                        @error('min_order')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Delivery Fee -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="delivery_fee" class="form-label">Delivery Fee</label>
                                        <input type="number" name="delivery_fee" value="{{ old('delivery_fee', $model->delivery_fee) }}" class="form-control" id="delivery_fee" required>
                                        @error('delivery_fee')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Contact Phone -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="contact_phone" class="form-label">Restaurant Contact Phone</label>
                                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $model->contact_phone) }}" class="form-control" id="contact_phone" required>
                                        @error('contact_phone')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="whatsapp_number" class="form-label">Restaurant WhatsApp</label>
                                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $model->whatsapp_number) }}" class="form-control" id="whatsapp_number" required>
                                        @error('whatsapp_number')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
