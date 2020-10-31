@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Почта</th>
                <th scope="col">Роли</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->roles()->get())
                                @foreach ($user->roles()->get() as $role)
                        <a tabindex="0" class="btn btn-sm btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="{{ $role->title }}" data-content="{{ $role->description }}">{{$role->title}}</a>
                                @endforeach
                            @else
                            У данного пользователя нет ролей
                            @endif
                        </td>
                        <td><a href="/dash/users/{{ $user->id }}" class="btn btn-success btn-sm">Изменить</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
