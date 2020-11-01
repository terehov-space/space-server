@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Добавление новой задачи</div>

                <div class="card-body">
                    <form method="POST" action="/dash/projects/{{ $project }}/tasks">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Название</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>

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
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">Дедлайн</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Заказчик</label>

                            <div class="col-md-6">
                                <select class="assigned-selector" name="assigned_to">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ ($user->id == Auth::user()->id)? 'selected': ''}}>{{ $user->name }}({{$user->id}})</option>
                                    @endforeach
                                  </select>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Добавить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.assigned-selector').selectpicker({liveSearch:true});
    });
</script>
@endsection
