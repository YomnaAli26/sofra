<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Area</th>
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
            <td>{{$datum->area->name}}</td>
            <td>
                <a class="btn btn-primary" href="{{ route("admin.clients.show",$datum->id) }}">show</a>
                <a class="btn btn-info" href="{{ route("admin.clients.edit",$datum->id) }}">edit</a>
                <a class="btn btn-danger" href="{{ route("admin.clients.destroy",$datum->id) }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                    delete
                </a>
                <form id="delete-form-{{$datum->id}}"
                      action="{{ route("admin.clients.destroy",$datum->id) }}"
                      method="post" style="display: none;">
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
    @empty
        <tr class="align-middle">
            <td colspan="6">No Data Found</td>
        </tr>
    @endforelse
    </tbody>
</table>
