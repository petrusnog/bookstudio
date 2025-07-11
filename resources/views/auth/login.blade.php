@extends('layouts.app')

@section('pagename')
    Login
@endsection

@section('content')
    <section class="section">
        @if (session('error'))
            <article class="message is-danger">
                <div class="message-header">
                    <p>Erro</p>
                    <button class="delete" aria-label="delete"></button>
                </div>
                <div class="message-body">
                    {{ session('error') }}
                </div>
            </article>
        @endif
        <div class="container">
            <div class="column is-half is-offset-one-quarter is-flex is-flex-direction-column is-align-items-center">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Book Studio Logo" class="logo">
                </a>
                <form method="POST" action="{{ route('login') }}" class="box column is-full">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="field mb-3">
                        <label class="label">E-mail</label>
                        <div class="control">
                            <input class="input" type="email" name="email" placeholder="Digite seu e-mail" required
                                autofocus>
                        </div>
                    </div>

                    <div class="field mb-3">
                        <label class="label">Senha</label>
                        <div class="control">
                            <input class="input" type="password" name="password" placeholder="Digite sua senha" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="checkbox">
                            <input type="checkbox" name="remember">
                            Lembrar de mim
                        </label>
                    </div>

                    <div class="field is-grouped is-justify-content-center mt-4">
                        <div class="control">
                            <button type="submit" class="button is-primary">Entrar</button>
                        </div>
                        <div class="control">
                            <a href="/" class="button is-light">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.message .delete');

            deleteButtons.forEach(($delete) => {
                const $message = $delete.closest('.message');

                $delete.addEventListener('click', () => {
                    $message.remove();
                });
            });
        });
    </script>
@endsection
