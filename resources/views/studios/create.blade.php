@extends('layouts.app')

@section('pagename')
    Cadastrar Estúdio
@endsection

@section('content')
    <div class="is-flex is-justify-content-space-between mb-4">
        <a href="{{ route('studios.index') }}" class="button is-info" style="color: white">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>
    <form method="POST" action="{{ route('studios.store') }}" class="box">
        @csrf

        <div class="field mb-3">
            <label class="label">Nome</label>
            <div class="control">
                <input class="input" type="text" name="name" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Endereço</label>
            <div class="control">
                <input class="input" type="text" name="address" value="{{ old('email') }}" required>
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

        <h1 class="title is-5 mb-4 mt-4">Disponibilidade do estúdio</h1>

        <button id="add-availability" class="button is-info" style="color: white;">
            <i class="fa-solid fa-plus mr-2"></i>
            Adicionar
        </button>

        <div id="availabilities">
        </div>

        <div class="field is-grouped is-justify-content-end mt-4">
            <div class="control">
                <button type="submit" class="button is-primary" style="color: white">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Salvar
                </button>
            </div>
        </div>
    </form>
@endsection
