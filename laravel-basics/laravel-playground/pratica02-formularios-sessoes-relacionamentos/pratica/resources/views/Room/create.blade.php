<x-layout title="Rooms" page="Create" back="{{ true }}" add="{{ false }}" routeAdd="">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Type the name of the room.." value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" name="capacity" placeholder="Type the capacity of the room." value="{{ old('capacity') }}">
        </div>

        <button class="btn btn-secondary" type="submit">Submit</button>
    </form>
</x-layout>
