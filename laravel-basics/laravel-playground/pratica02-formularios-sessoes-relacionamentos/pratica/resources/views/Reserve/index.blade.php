<x-layout title="Reserves" page="Index" back="{{ false }}" add="{{ true }}" routeAdd="reserves.create">

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Reserve date</th>
                <th scope="col">Start time</th>
                <th scope="col">End time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reserves as $reserve)
                <tr>
                    <th scope="row">{{ $reserve->id }}</th>
                    <td>{{ $reserve->reserve_date }}</td>
                    <td>{{ $reserve->start_time }}</td>
                    <td>{{ $reserve->end_time }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('reserves.edit', $reserve->id) }}" class="btn btn-primary">Edit</a>
                            
                            <a href="{{ route('reserves.show', $reserve->id) }}" class="btn btn-primary">Show</a>

                            <form action="{{ route('reserves.destroy', $reserve->id) }}" method="POST">
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Del</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>
