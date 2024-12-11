<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Client</th>
        <th>Restaurant</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $datum)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $datum->client->name }}</td>
            <td>{{ $datum->restaurant->name }}</td>
            <td>{{ $datum->total_amount }}</td>
            <td>{{ $datum->status }}</td>
            <td>{{ $datum->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $datum->id) }}" class="btn btn-primary btn-sm">View</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">No Orders Found</td>
        </tr>
    @endforelse
    </tbody>
</table>
