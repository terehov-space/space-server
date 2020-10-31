@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user())
            @if (Auth::user()->hasRole('guest'))
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Панель управления</div>

                        <div class="card-body">
                                    Подождите пока вашу учетную запись одобрит администратор
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
