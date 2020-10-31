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
              <th scope="col" style="text-align: right;">Действия<a href="/dash/projects/{{$project}}/tasks/add" class="btn btn-success btn-sm" style="margin-left: 10px;">Добавить</a></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->deadline ?? ''}}</td>
                        <td>
                            <a tabindex="0" class="btn btn-sm btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="{{ $task->tag()->first()->title }}" data-content="{{ $task->tag()->first()->description }}">{{$task->tag()->first()->title}}</a>
                        </td>
                        <td style="text-align: right;">
                        <a href="/dash/projects/{{ $project }}/tasks/{{$task->id}}" class="btn btn-success btn-sm">Посмотреть</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
