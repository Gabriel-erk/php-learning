<x-layout title="Users" page="Create" back="{{ true }}" add="{{ false }}" route="">
    <form action="{{ route('users.store') }}" method="POST">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Type your name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="name@email.com">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="*******">
        </div>

        <button class="btn btn-secondary" type="submit">Submit</button>

    </form>
</x-layout>
