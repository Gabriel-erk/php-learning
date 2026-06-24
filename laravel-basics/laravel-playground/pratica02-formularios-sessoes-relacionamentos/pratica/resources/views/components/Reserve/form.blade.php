<x-layout title="Reserves" page="{{ $edit ? 'Edit' : 'Create' }}" back="{{ true }}" add="{{ false }}"
    routeAdd="">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $edit ? route('reserves.update', $reserf->id) : route('reserves.store') }}" method="POST">
        @csrf
        @if ($edit)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <input type="number" class="form-control" name="user_id" placeholder="Enter user ID"
                value="{{ $edit ? old('user_id', $reserf->user_id) : old('user_id') }}">
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Room ID</label>
            <input type="number" class="form-control" name="room_id" placeholder="Enter room ID"
                value="{{ $edit ? old('room_id', $reserf->room_id) : old('room_id') }}">
        </div>

        <div class="mb-3">
            <label for="reserve_date" class="form-label">Reserve date</label>
            <input type="date" class="form-control" name="reserve_date"
                value="{{ $edit ? old('reserve_date', $reserf->reserve_date) : old('reserve_date') }}">
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start time</label>
            <input type="datetime-local" class="form-control" name="start_time"
                value="{{ $edit ? old('start_time', $reserf->start_time) : old('start_time') }}">
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End time</label>
            <input type="datetime-local" class="form-control" name="end_time"
                value="{{ $edit ? old('end_time', $reserf->end_time) : old('end_time') }}">
        </div>

        <div class="mb-3">
            <label for="observation" class="form-label">Observation</label>
            <input type="text" class="form-control" name="observation" value="{{ $edit ? old('observation', $reserf->observation) : old('observation') }}">
        </div>

        <button class="btn btn-secondary" type="submit">Submit</button>

    </form>
</x-layout>
