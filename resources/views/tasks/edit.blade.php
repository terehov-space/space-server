@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Редактировать проект #{{ $project->id }}
                @if ($project->deleted)
                <span class="badge badge-secondary">Удален</span>
                @endif
            </div>

                <div class="card-body">
                    <form method="POST" action="/dash/projects/{{ $project->id }}/update">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Название</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ $project->title }}" required autocomplete="name" autofocus {{ ($project->deleted)? 'disabled': '' }}>

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
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="email" {{ ($project->deleted)? 'disabled': '' }}>{{ $project->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">Дедлайн</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ $project->deadline }}" {{ ($project->deleted)? 'disabled': '' }}>
                            </div>
                        </div>

                        @if (!$project->deleted)
                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Сохранить
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="/dash/projects/{{ $project }}/delete" class="btn btn-danger">
                                    Удалить
                                </a>
                            </div>
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
        $('.role-selector').selectpicker({liveSearch:true});
    });
</script>
@endsection
