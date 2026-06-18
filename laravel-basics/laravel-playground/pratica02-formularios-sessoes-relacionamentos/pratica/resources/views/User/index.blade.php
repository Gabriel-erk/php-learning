<x-layout title="Users" page="Index" back="{{ false }}" add="{{ true }}" route="users.create">

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Show</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
