@extends('layouts.app')

@section('pagename')
    Editar Usuário
@endsection

@section('content')
    <div class="is-flex is-justify-content-space-between mb-4">
        <a href="{{ route('users.list') }}" class="button is-info" style="color: white">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="box">
        @csrf
        @method('PUT')

        <div class="field mb-3">
            <label class="label">Nome</label>
            <div class="control">
                <input class="input" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">E-mail</label>
            <div class="control">
                <input class="input" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Telefone</label>
            <div class="control">
                <input class="input" type="tel" name="phone" pattern="^\(\d{2}\)\s9?\d{4}-\d{4}$"
                    value="{{ old('phone', $user->phone) }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Senha (deixe em branco para não alterar)</label>
            <div class="control">
                <input class="input" type="password" name="password">
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Confirme a Senha</label>
            <div class="control">
                <input class="input" type="password" name="password_confirmation">
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Perfil</label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select name="role_id" required>
                        <option value="">Selecione...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="field is-grouped is-justify-content-end mt-4">
            <div class="control">
                <button type="submit" class="button is-primary" style="color: white">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Salvar Alterações
                </button>
            </div>
        </div>
    </form>
@endsection
