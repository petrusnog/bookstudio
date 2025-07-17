@extends('layouts.app')

@section('pagename')
    Usuários
@endsection

@section('content')
    <div class="is-flex is-justify-content-space-between mb-4">
        <div class="is-flex">
            @if ((bool) $search)
                <a href="{{ route('users.index') }}" class="button is-info mr-2" style="color: white">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Voltar
                </a>
            @endif
            <form action="{{ route('users.index') }}" method="GET" class="is-flex">
                <input class="input is-normal mr-2" placeholder="Pesquisar" type="text" name="search" id="">
                <button type="submit" class="button is-primary" style="color: white;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
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
                <td>{{ $roles->firstWhere('id', $user->role_id)->label }}</td>
                <td>
                    <div class="is-flex">
                        <a href="{{ route('users.edit', $user->id) }}" class="button is-white is-info mr-2"
                            style="color: white">
                            <i class="fa-solid fa-bars mr-2"></i>
                            Editar
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger" style="color: white">
                                <i class="fa-solid fa-trash mr-2"></i>
                                Deletar
                            </button>
                        </form>
                    </div>
                </td>
            </tbody>
        @endforeach
    </table>
@endsection
