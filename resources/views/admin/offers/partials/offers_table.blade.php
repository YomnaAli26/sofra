<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Restaurant</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $datum)
        <tr class="align-middle">
            <td>{{$loop->iteration}}.</td>
            <td>{{$datum->name}}</td>
            <td>{{$datum->description}}</td>
            <td>{{$datum->from}}</td>
            <td>{{$datum->to}}</td>
            <td>{{$datum->restaurant->name}}</td>
            <td colspan="3">
                <a class="btn btn-danger"
                   href="{{ route("admin.offers.destroy",$datum->id) }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$datum->id}}').submit()">
                    delete
                </a>
                <form id="delete-form-{{$datum->id}}"
                      action="{{ route("admin.offers.destroy",$datum->id)  }}"
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
