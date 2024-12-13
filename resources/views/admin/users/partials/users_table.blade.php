<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $datum)
        <tr class="align-middle">
            <td>{{$loop->iteration}}.</td>
            <td>{{$datum->name}}</td>
            <td>{{$datum->email}}</td>

            <td>
                <a class="btn btn-success" id="toggle" data-id = "{{$datum->id}}" data-status="{{ $datum->is_active }}"
                   href="">Activate</a>
                <a class="btn btn-primary" href="{{ route("admin.users.show",$datum->id) }}">show</a>
                <a class="btn btn-info" href="{{ route("admin.users.edit",$datum->id) }}">edit</a>
                <a class="btn btn-danger" href="{{ route("admin.users.destroy",$datum->id) }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                    delete
                </a>
                <form id="delete-form-{{$datum->id}}"
                      action="{{ route("admin.users.destroy",$datum->id) }}"
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