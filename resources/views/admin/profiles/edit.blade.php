@extends('layouts.admin')
@section('title')
    Редактировать пользователя @parent
@endsection
@section('header')
    <h1 class="h2">Редактировать пользователя</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    <div>
        @include('inc.message')
        <form method="post" action="{{ route('admin.profiles.update', ['profile' => $profile]) }}" style="">
            @csrf
            @method('put')
            <div class="form-group" >
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $profile->name }}">
            </div>
            <div class="form-group" >
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $profile->email }}" readonly>
            </div>
            <div class="form-group">
                <div>Права администратора</div>
                <input type="radio" id="is_admin"
                       name="is_admin" value="1" @if($profile->is_admin == '1') checked @endif>
                <label for="is_admin">Администратор</label>
                <br>
                <input type="radio" id="is_user"
                       name="is_admin" value="0" @if($profile->is_admin == '0') checked @endif>
                <label for="is_user">Пользователь</label>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
        </form>
    </div>
@endsection
