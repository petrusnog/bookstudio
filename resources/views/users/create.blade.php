@extends('layouts.app')

@section('pagename')
    Cadastrar Usuário
@endsection

@section('content')
    <div class="is-flex is-justify-content-space-between mb-4">
        <a href="{{ route('users.index') }}" class="button is-info" style="color: white">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>
    <form method="POST" action="{{ route('users.create') }}" class="box">
        @csrf

        <div class="field mb-3">
            <label class="label">Nome</label>
            <div class="control">
                <input class="input" type="text" name="name" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">E-mail</label>
            <div class="control">
                <input class="input" type="email" name="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Telefone</label>
            <div class="control">
                <input class="input" type="tel" name="phone" pattern="^\(\d{2}\)\s9?\d{4}-\d{4}$"
                    value="{{ old('phone') }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Senha</label>
            <div class="control">
                <input class="input" type="password" name="password" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Confirme a Senha</label>
            <div class="control">
                <input class="input" type="password" name="password_confirmation" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Perfil</label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select name="role_id" required>
                        <option value="">Selecione...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
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
