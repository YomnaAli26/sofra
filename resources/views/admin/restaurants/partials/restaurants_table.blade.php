<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Image</th>
        <th>Area</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $datum)
        <tr class="align-middle">
            <td>{{$loop->iteration}}.</td>
            <td>{{$datum->name}}</td>
            <td>{{$datum->email}}</td>
            <td>{{$datum->phone}}</td>
            <td>
                <img src="{{ $datum->image_path }}" style="width: 50px; height: 50px; border-radius: 50%;">
            </td>
            <td>{{$datum->area?->name}}</td>
            <td>{{$datum->category?->name}}</td>
            <td colspan="3">
                <a class="btn btn-success" id="toggle"  data-id = "{{$datum->id}}" data-status="{{ $datum->is_active }}"
                   href="{{ route("admin.restaurants.toggle",$datum->id) }}">Activate</a>
                <a class="btn btn-primary" href="{{ route("admin.restaurants.show",$datum->id) }}">Show</a>
                <a class="btn btn-info" href="{{ route("admin.restaurants.edit",$datum->id) }}">Edit</a>
                <a class="btn btn-danger"
                   href="{{ route("admin.restaurants.destroy",$datum->id) }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                    Delete
                </a>
                <form id="delete-form-{{$datum->id}}"
                      action="{{ route("admin.restaurants.destroy",$datum->id)  }}"
                      method="post" style="display: none;">
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
    @empty
        <tr class="align-middle">
            <td colspan="7">No Data Found</td>
        </tr>
    @endforelse
    </tbody>
</table>
