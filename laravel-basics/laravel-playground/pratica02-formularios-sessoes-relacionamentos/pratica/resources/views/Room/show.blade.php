<x-layout title="Rooms" page="Show" back="{{ true }}" add="{{ false }}" routeAdd="">
    <div class="mt-5">

        <div class="mb-4">
            <h1 class="fw-bold">{{ $room->name }}</h1>
            <p class="text-muted">{{ $room->capacity }}</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="card-title mb-4">Informations</h5>

                <div>
                    <strong>Room:</strong>
                    <p>{{ $room->name }}</p>
                </div>

                <div>
                    <strong>Capacity:</strong>
                    <p>{{ $room->capacity }}</p>
                </div>

            </div>
        </div>

        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary my-4">
            Edit
        </a>

    </div>
</x-layout>
