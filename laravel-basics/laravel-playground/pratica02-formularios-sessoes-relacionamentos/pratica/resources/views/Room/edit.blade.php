<x-layout title="Rooms" page="Edit" back="{{ true }}" add="{{ false }}" routeAdd="">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $room->name }}">
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" name="capacity" value="{{ old('capacity') ? old('capacity') : $room->capacity }}">
        </div>

        <button class="btn btn-secondary" type="submit">Submit</button>
    </form>
</x-layout>
