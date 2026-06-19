<x-layout title="Users" page="Show" back="{{ true }}" add="{{ false }}" route="">
    <div class="mt-5">

        <div class="mb-4">
            <h1 class="fw-bold">{{ $user->name }}</h1>
            <p class="text-muted">{{ $user->email }}</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="card-title mb-4">Informations</h5>

                <div>
                    <strong>Name:</strong>
                    <p>{{ $user->name }}</p>
                </div>

                <div>
                    <strong>Email:</strong>
                    <p>{{ $user->email }}</p>
                </div>

            </div>
        </div>

        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary my-4">
            Edit
        </a>

    </div>
</x-layout>
