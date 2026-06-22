<x-layout title="Reserves" page="Create" back="{{ true }}" add="{{ false }}" route="">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reserves.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <input type="number" class="form-control" name="user_id" placeholder="Enter user ID"
                value="{{ old('user_id') }}">
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Room ID</label>
            <input type="number" class="form-control" name="room_id" placeholder="Enter room ID"
                value="{{ old('room_id') }}">
        </div>

        <div class="mb-3">
            <label for="reserve_date" class="form-label">Reserve date</label>
            <input type="date" class="form-control" name="reserve_date" value="{{ old('reserve_date') }}">
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start time</label>
            <input type="datetime-local" class="form-control" name="start_time" value="{{ old('start_time') }}">
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End time</label>
            <input type="datetime-local" class="form-control" name="end_time" value="{{ old('end_time') }}">
        </div>

        <div class="mb-3">
            <label for="observation" class="form-label">Observation</label>
            <input type="text" class="form-control" name="observation" value="{{ old('observation') }}">
        </div>

        <button class="btn btn-secondary" type="submit">Submit</button>

    </form>
</x-layout>
