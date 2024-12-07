@extends("admin.layout.master")

@section("title", "Create Restaurant")
@section("breadcrumb_header", "Create Restaurant")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Create Restaurant</li>
@endsection

@section("content")
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Add New Restaurant</h3>
                        </div>

                        <!-- Form Start -->
                        <form class="needs-validation" method="post"
                              action="{{ route('admin.restaurants.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Restaurant Name -->
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Restaurant Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-12">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" required>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Contact Phone -->
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- WhatsApp Number -->
                                    <div class="col-md-12">
                                        <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                                               class="form-control @error('whatsapp_number') is-invalid @enderror"
                                               id="whatsapp_number" required>
                                        @error('whatsapp_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="contact_phone" class="form-label">Contact Phone</label>
                                        <input type="text" name="contact_phone" value="{{ old('contact_phone') }}"
                                               class="form-control @error('contact_phone') is-invalid @enderror"
                                               id="contact_phone" required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Area -->
                                    <div class="col-md-12">
                                        <label for="area" class="form-label">Area</label>
                                        <select name="area_id"
                                                class="form-control @error('area_id') is-invalid @enderror"
                                                id="area" required>
                                            <option value="" selected disabled>Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" @selected($area->id == old("area_id"))>
                                                    {{ $area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-12">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror"
                                                id="category" required>
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @selected($category->id == old("category_id"))>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">Restaurant Image</label>
                                        <input type="file" name="image"
                                               class="form-control @error('image') is-invalid @enderror"
                                               id="image" required>
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Minimum Order -->
                                    <div class="col-md-12">
                                        <label for="min_order" class="form-label">Minimum Order</label>
                                        <input type="number" name="min_order" value="{{ old('min_order') }}"
                                               class="form-control @error('min_order') is-invalid @enderror"
                                               id="min_order" required>
                                        @error('min_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Delivery Fee -->
                                    <div class="col-md-12">
                                        <label for="delivery_fee" class="form-label">Delivery Fee</label>
                                        <input type="number" name="delivery_fee" value="{{ old('delivery_fee') }}"
                                               class="form-control @error('delivery_fee') is-invalid @enderror"
                                               id="delivery_fee" required>
                                        @error('delivery_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Create Restaurant</button>
                            </div>
                        </form>
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (() => {
            "use strict";
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
