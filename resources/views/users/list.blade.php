@extends('layouts.app')

@section('pagename')
    Usuários
@endsection

@section('content')
    <div class="is-flex is-justify-content-space-between mb-4">
        <form action="#" class="is-flex">
            <input class="input is-normal mr-2" placeholder="Pesquisar" type="text" name="" id="">
            <button type="submit" class="button is-primary" style="color: white;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <a href="{{ route('users.create') }}" class="button is-primary" style="color: white">
            <i class="fa-solid fa-plus mr-2"></i>
            Criar novo
        </a>
    </div>
    <table class="table us-striped is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Tipo de usuário</th>
                <th>Ações</th>
            </tr>
        </thead>

        @foreach ($users as $user)
            <tbody>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $roles->firstWhere('id', $user->role_id)->label; }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="button is-white is-info" style="color: white">
                        <i class="fa-solid fa-bars mr-2"></i>
                        Editar
                    </a>
                </td>
            </tbody>
        @endforeach
    </table>
@endsection
