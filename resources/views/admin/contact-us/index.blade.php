@extends("admin.layout.master")
@section("title", "contact-us")
@section("breadcrumb_header", "contact-us")
@section("breadcrumb")
    @parent
    <li class="breadcrumb-item active" aria-current="page">contacts</li>
@endsection
@section("content")
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <x-alert type="success"/>
                    <x-alert type="danger"/>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">contacts</h3>
                        </div>
                        <div class="card-body">
                            <!--begin::Filter Form-->
                            <form id="offerForm" class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ request('name') }}" placeholder="Search by name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                               value="{{ request('email') }}" placeholder="Search by description">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                               value="{{ request('phone') }}" placeholder="Search by restaurant">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="message" class="form-label">Message</label>
                                        <input type="text" name="message" id="message" class="form-control"
                                               value="{{ request('message') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="status" class="form-label">status</label>
                                        <select name="status" id=status" class="form-control">
                                            @foreach(\App\Enums\ContactStatusEnum::cases() as $statusEnum)
                                                <option
                                                    value="{{ $statusEnum->value }}"> {{ $statusEnum->value}} </option>

                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100 mt-4">
                                            <i class="fas fa-filter"></i> Apply Filters
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Filter Form-->

                            <div id="offersTable">
                                @include('admin.contact-us.partials.contacts_table', ['data' => $data])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#offerForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.offers.index') }}",
                    type: "GET",
                    data: formData,
                    success: function (response) {
                        $('#offersTable').html(response);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong while fetching offers.');
                    }
                });
            });
        });
    </script>
@endpush
