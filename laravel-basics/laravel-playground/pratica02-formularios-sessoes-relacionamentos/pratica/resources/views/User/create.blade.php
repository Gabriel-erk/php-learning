<x-layout title="Users" page="Create" back="{{ true }}" add="{{ false }}" route="">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            {{-- caso aconteća algum erro de validaćão e continue nessa página, graćas ao {{ old('') }} no value(== valor do nosso input) ele ele continuará nessa página aqui e colocará o valor da antiga requisićão (por isso old, de velho, antigo) o valor que o usuário digitou antes de subir a requisićão que retornou erro e voltou para esta página, valor do parâmetro do old é o valor do 'name' do nosso input, então ele colocará no value do nosso input abaixo o valor do input que possuia a tag 'name' == name (old('name')) --}}
            <input type="text" class="form-control" name="name" placeholder="Type your name" value="{{ old('name') }}"> 
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="name@email.com" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="*******" value="{{ old('password') }}">
        </div>

        <button class="btn btn-secondary" type="submit">Submit</button>

    </form>
</x-layout>
