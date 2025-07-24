@extends('layouts.app')

@section('pagename')
    Editar Estúdio
@endsection

@section('content')
    <div class="is-flex is-justify-content-space-between mb-4">
        <a href="{{ route('studios.index') }}" class="button is-info" style="color: white">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>
    <form method="POST" action="{{ route('studios.update', $studio->id) }}" class="box">
        @csrf
        @method('PUT')
        <h2 class="title is-4 mb-4 mt-4">Dados cadastrais</h2>
        <div class="field mb-3">
            <label class="label">Nome</label>
            <div class="control">
                <input class="input" type="text" name="name" value="{{ old('name', $studio->name) }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Endereço</label>
            <div class="control">
                <input class="input" type="text" name="address" value="{{ old('address', $studio->address) }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">E-mail</label>
            <div class="control">
                <input class="input" type="email" name="email" value="{{ old('email', $studio->email) }}" required>
            </div>
        </div>

        <div class="field mb-3">
            <label class="label">Telefone</label>
            <div class="control">
                <input class="input" type="tel" name="phone" pattern="^\(\d{2}\)\s9?\d{4}-\d{4}$"
                    value="{{ old('phone', $studio->phone) }}" required>
            </div>
        </div>

        <div class="field is-grouped is-justify-content-end mt-4">
            <div class="control">
                <button type="submit" class="button is-primary" style="color: white">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Salvar
                </button>
            </div>
        </div>

        @php
            $index = 0;
            $weekdays = [
                ['value' => 'monday', 'label' => 'Segunda-feira'],
                ['value' => 'tuesday', 'label' => 'Terça-feira'],
                ['value' => 'wednesday', 'label' => 'Quarta-feira'],
                ['value' => 'thursday', 'label' => 'Quinta-feira'],
                ['value' => 'friday', 'label' => 'Sexta-feira'],
                ['value' => 'saturday', 'label' => 'Sábado'],
                ['value' => 'sunday', 'label' => 'Domingo'],
            ];
        @endphp

        <h1 class="title is-4 mb-4 mt-4">Disponibilidade do estúdio</h1>

        <button id="add-availability" class="button is-info" style="color: white;">
            <i class="fa-solid fa-plus mr-2"></i>
            Adicionar
        </button>

        <div id="availabilities">
            @foreach ($availabilities as $availability)
                <div class="availability-card message is-info mt-3">
                    <div class="message-header">
                        <p style="color: white">Disponibilidade</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body" style="background: rgb(217 217 217)">
                        <div class="control">
                            <label class="label">Dias da semana:</label>
                            <div class="field checkboxes mb-3">
                                @foreach ($weekdays as $weekday)
                                    @php
                                        $checked = in_array($weekday['value'], json_decode($availability->weekdays));
                                    @endphp
                                    <label class="checkbox">
                                        <input type="checkbox" name="availabilities[{{ $index }}][weekdays][]"
                                            value="{{ $weekday['value'] }}"
                                            @if ($checked) checked @endif />
                                        {{ $weekday['label'] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="is-flex">
                            <div class="control has-icons-left has-icons-right mr-4">
                                <label class="label">Abre:</label>
                                <input class="input" type="time" name="availabilities[{{ $index }}][open_time]"
                                    value="{{ $availability->open_time }}" />
                            </div>
                            <div class="control has-icons-left has-icons-right">
                                <label class="label">Fecha:</label>
                                <input class="input" type="time" name="availabilities[{{ $index }}][close_time]"
                                    value="{{ $availability->close_time }}" />
                            </div>
                        </div>
                    </div>
                </div>
                @php $index++; @endphp
            @endforeach
        </div>
    </form>
@endsection
