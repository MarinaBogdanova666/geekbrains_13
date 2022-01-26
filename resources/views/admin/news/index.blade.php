@extends('layouts.admin')
@section('title')
    Список новостей @parent
@endsection
@section('header')
    <h1 class="h2">Список новостей</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-outline-secondary">
                Добавить новость
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Заголовок</th>
                <th>Статус</th>
                <th>Автор</th>
                <th>Описание</th>
                <th>Опции</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $news)
                <tr>
                    <td>{{ $news->id }}</td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->status }}</td>
                    <td>{{ $news->author }}</td>
                    <td>{{ $news->description }}</td>
                    <td><a href="{{ route('admin.news.edit', ['news' => $news->id]) }}">Ред.</a>&nbsp;
                        <a href="javascript:;" style="color: red;">Уд.</a></td>
                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Записей нет</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

<h1 class="h2">Отзыв</h1>
    <div>
        <form method="post" action="{{ route('admin.news.store') }}">
            @csrf
            <div class="form-group" >
                <label for="title">Имя пользователя</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Поле для ввода комментария / отзыва по работе проекта</label>
                <textarea class="form-control" name="description" id="description" cols="10" rows="5">{!! old('description') !!}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
        </form>
    </div>
    <br>
    <div>

<h1 class="h2">Форма заказа на получение выгрузки данных</h1>

        <form method="post" action="{{ route('admin.news.store') }}">
            @csrf
            <div class="form-group" >
                <label for="title">Имя</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="number">Номер телефона</label>
                <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}">
            </div>
            <div class="form-group">
                <label for="email">Email-адрес</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="description">Информации о том, что вы хотите получить</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="7">{!! old('description') !!}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Отправить заявку</button>
        </form>
    </div>
@endsection
