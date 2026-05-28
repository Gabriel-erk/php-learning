<x-layout title="Users">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Actions</th>
            </tr>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    {{-- fazer botões de excluir e editar --}}
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
</x-layout>
