@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Статус</th>
                        <th scope="col" style="text-align: right;">Действия
                            @if (Auth::user()->hasRole('manager'))
                                <a href="/dash/projects/add" class="btn btn-success btn-sm"
                                    style="margin-left: 10px;">Добавить</a>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->deadline ?? '' }}</td>
                            <td>
                                <a tabindex="0" class="btn btn-sm btn-danger" role="button" data-toggle="popover"
                                    data-trigger="focus" title="{{ $project->tag()->first()->title }}"
                                    data-content="{{ $project->tag()->first()->description }}">{{ $project->tag()->first()->title }}</a>
                            </td>
                            <td style="text-align: right;">
                                <a href="/dash/projects/{{ $project->id }}/tasks" class="btn btn-success btn-sm">Задачи</a>
                                <a href="/dash/projects/{{ $project->id }}" class="btn btn-success btn-sm">Посмотреть</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
