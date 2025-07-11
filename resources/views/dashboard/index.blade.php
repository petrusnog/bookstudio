@extends('layouts.app')

@section('pagename')
    Home
@endsection

@section('content')
    {{-- Saudação --}}
    <div class="notification is-primary mb-3">
        <strong>Olá, {{ auth()->user()->name }}!</strong> Você está logado como <span
            class="tag is-light">{{ auth()->user()->role->label }}</span>.
    </div>

    {{-- Grid responsiva --}}
    <div class="columns is-multiline">

        <div class="column is-one-third">
            <div class="card">
                <div class="card-content">
                    <p class="title is-5">Agendamentos futuros</p>
                    <p class="subtitle is-3">5</p>
                </div>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="card">
                <div class="card-content">
                    <p class="title is-5">Salas disponíveis</p>
                    <p class="subtitle is-3">2</p>
                </div>
            </div>
        </div>


        <div class="column is-one-third">
            <div class="card">
                <div class="card-content">
                    <p class="title is-5">Último login</p>
                    <p class="subtitle is-6">{{ now()->subDays(1)->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabela de agendamentos --}}
    <div class="box mt-5">
        <h2 class="title is-5 mb-3">Próximos agendamentos</h2>

        <table class="table is-fullwidth is-striped is-hoverable">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Sala</th>
                    <th>Estúdio</th>
                </tr>
            </thead>
            <tbody>
                {{-- Simulação --}}
                <tr>
                    <td>12/07/2025</td>
                    <td>18:00 - 20:00</td>
                    <td>Sala 2</td>
                    <td>Studio Z</td>
                </tr>
                <tr>
                    <td>15/07/2025</td>
                    <td>14:00 - 16:00</td>
                    <td>Sala Acústica</td>
                    <td>BookStudio Matriz</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
