@extends('layouts.app')

@section('pagename')
    Estúdios
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
        <a href="{{ route('studios.create') }}" class="button is-primary" style="color: white">
            <i class="fa-solid fa-plus mr-2"></i>
            Criar novo
        </a>
    </div>
    @if(count($studios) > 0)
        <table class="table us-striped is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>

            @foreach ($studios as $studio)
                <tbody>
                    <td>{{ $studio->name }}</td>
                    <td>{{ $studio->address }}</td>
                    <td>{{ $studio->email }}</td>
                    <td>{{ $studio->phone }}</td>
                    <td>
                        <div class="is-flex">
                            <a href="{{ route('studios.edit', $studio->id) }}" class="button is-white is-info mr-2"
                                style="color: white">
                                <i class="fa-solid fa-bars mr-2"></i>
                                Editar
                            </a>
                            <form action="{{ route('studios.destroy', $studio->id) }}" method="POST">
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
    @else
        <div class="column is-full is-flex is-justify-content-center no-records">
            Nenhum estúdio cadastrado.
        </div>
    @endif
@endsection
