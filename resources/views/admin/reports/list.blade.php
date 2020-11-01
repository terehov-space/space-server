@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Проектов</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectsByStatus as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->cnt }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Проектов</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasksByStatus as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->cnt }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Роль</th>
                            <th scope="col">Пользователей</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersByRoles as $users)
                            <tr>
                                <td>{{ $users->title }}</td>
                                <td>{{ $users->cnt }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
