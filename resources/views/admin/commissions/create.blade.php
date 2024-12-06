@extends("admin.layout.master")

@section("title", "Commissions")
@section("breadcrumb_header", "Commissions")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">Commissions</li>
@endsection

@section("content")
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Create Commission</h3>
                        </div>

                        <!-- Form Start -->
                        <form class="needs-validation" method="post"
                              action="{{ route('admin.commissions.store') }}" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Restaurant ID -->
                                    <div class="col-md-12">
                                        <label for="restaurant-id" class="form-label">Restaurants</label>
                                        <select name="restaurant_id"
                                                class="form-control @error('restaurant_id') is-invalid @enderror"
                                                id="restaurant-id" required>
                                            <option value="" selected disabled>Select Restaurant</option>
                                            @foreach($restaurants as $restaurant)
                                                <option value="{{ $restaurant->id }}"> {{ $restaurant->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('restaurant_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Paid -->
                                    <div class="col-md-12">
                                        <label for="paid" class="form-label">Paid Amount</label>
                                        <input type="text" name="paid" value="{{ old('paid') }}"
                                               class="form-control @error('paid') is-invalid @enderror"
                                               id="paid" required>
                                        @error('paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-md-12">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror"
                                                  id="notes">{{ old('notes') }}</textarea>
                                        @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Optional, looks good!</div>
                                            @enderror
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-12">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" value="{{ old('date') }}"
                                               class="form-control @error('date') is-invalid @enderror"
                                               id="date" required>
                                        @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="valid-feedback">Looks good!</div>
                                            @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">Create</button>
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
