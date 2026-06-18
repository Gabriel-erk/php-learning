<x-layout title="Reserves" page="Show" back="{{ true }}" add="{{ false }}" route="">
    <div class="mt-5">

        <div class="mb-4">
            <h1 class="fw-bold">Reserve for: {{ $reserve->reserve_date }}</h1>
            <p class="text-muted">{{ $reserve->observation }}</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="card-title mb-4">Informations</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>User ID:</strong>
                        <p>{{ $reserve->user_id }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Room ID:</strong>
                        <p>{{ $reserve->room_id }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Start time:</strong>
                        <p>{{ $reserve->start_time }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>End time:</strong>
                        <p>{{ $reserve->end_time }}</p>
                    </div>
                </div>

                <div>
                    <strong>Observation:</strong>
                    <p>{{ $reserve->observation }}</p>
                </div>

            </div>
        </div>

        <a href="{{ route('reserves.edit', $reserve->id) }}" class="btn btn-primary mt-4">
            Edit
        </a>

    </div>
</x-layout>
