<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Restaurant Name</th>
        <th>Paid</th>
        <th>Notes</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $datum)
        <tr class="align-middle">
            <td>{{$loop->iteration}}.</td>
            <td>{{$datum->restaurant?->name}}</td>
            <td>{{$datum->paid}}</td>
            <td>{{ !empty($datum->notes) ? $datum->notes : 'Not Found' }}</td>
            <td>{{$datum->date}}</td>
            <td>
                <a class="btn btn-primary"
                   href="{{ route('admin.commissions.show', $datum->id) }}">View</a>
                <a class="btn btn-info"
                   href="{{ route('admin.commissions.edit', $datum->id) }}">Edit</a>
                <a class="btn btn-danger"
                   href="{{ route('admin.commissions.destroy', $datum->id) }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                    Delete
                </a>
                <form id="delete-form-{{$datum->id}}"
                      action="{{ route('admin.commissions.destroy', $datum->id) }}"
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
