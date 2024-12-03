<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Status</th>
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
            <td>{{$datum->message}}</td>
            <td>{{$datum->status}}</td>
            <td colspan="3">
                <a class="btn btn-danger"
                   href="{{ route("admin.contact-us.destroy",$datum->id) }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                    delete
                </a>
                <form id="delete-form-{{$datum->id}}"
                      action="{{ route("admin.contact-us.destroy",$datum->id)  }}"
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
