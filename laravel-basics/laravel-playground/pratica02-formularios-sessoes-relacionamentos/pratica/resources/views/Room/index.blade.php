<x-layout title="Rooms" page="Index" add="{{ true }}" route="rooms.create" back="{{ false }}" routeAdd="rooms.create">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Capacity</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <th scope="row">{{ $room->id }}</th>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">Edit</a>

                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary">Show</a>

                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
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
