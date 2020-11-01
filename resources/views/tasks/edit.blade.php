@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактировать задачи #{{ $task->id }}
                        @if ($task->deleted)
                            <span class="badge badge-secondary">Удален</span>
                        @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/dash/projects/{{ $project }}/tasks/{{ $task->id }}/update">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Название</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="title" value="{{ $task->title }}" required autocomplete="name" autofocus
                                        {{ $task->deleted ? 'disabled' : '' }}>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Описание</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text"
                                        class="form-control @error('description') is-invalid @enderror" name="description"
                                        autocomplete="email"
                                        {{ $task->deleted ? 'disabled' : '' }}>{{ $task->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deadline" class="col-md-4 col-form-label text-md-right">Дедлайн</label>

                                <div class="col-md-6">
                                    <input id="deadline" type="date"
                                        class="form-control @error('deadline') is-invalid @enderror" name="deadline"
                                        value="{{ $task->deadline }}" {{ $task->deleted ? 'disabled' : '' }}>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Заказчик</label>

                                <div class="col-md-6">
                                    <select class="assigned-selector" name="assigned_to">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $task->assigned_to ? 'selected' : '' }}>
                                                {{ $user->name }}({{ $user->id }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if (!$task->deleted)
                                <div class="form-group row mb-0">
                                    <div class="col-md-3 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            Сохранить
                                        </button>
                                    </div>
                                    @if (Auth::user()->hasRole('manager'))
                                        <div class="col-md-3">
                                            <a href="/dash/projects/{{ $project }}/tasks/{{ $task->id }}/delete"
                                                class="btn btn-danger">
                                                Удалить
                                            </a>
                                        </div>
                                    @elseif (Auth::user()->hasRole('developer'))
                                        @if ($task->tag_id == 5)
                                            <div class="col-md-3">
                                                <a href="/dash/projects/{{ $project }}/tasks/{{ $task->id }}/stc"
                                                    class="btn btn-danger">
                                                    На проверку
                                                </a>
                                            </div>
                                        @elseif ($task->tag_id != 7)
                                            <div class="col-md-3">
                                                <a href="/dash/projects/{{ $project }}/tasks/{{ $task->id }}/ttw"
                                                    class="btn btn-danger">
                                                    Взять работу
                                                </a>
                                            </div>
                                        @endif
                                    @elseif (Auth::user()->hasRole('client'))
                                        @if ($task->tag_id == 6)
                                            <div class="col-md-3">
                                                <a href="/dash/projects/{{ $project }}/tasks/{{ $task->id }}/sc"
                                                    class="btn btn-danger">
                                                    Проверить
                                                </a>
                                            </div>

                                            <div class="col-md-3">
                                                <a href="/dash/projects/{{ $project }}/tasks/{{ $task->id }}/stw"
                                                    class="btn btn-danger">
                                                    На доработки
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.assigned-selector').selectpicker({
                liveSearch: true
            });
        });

    </script>
@endsection
