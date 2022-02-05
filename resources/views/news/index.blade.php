@extends('layouts.main')
@section('title')
    Список новостей @parent
@endsection
@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Список новостей</h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($newsList as $news)
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    <div class="card-body">
                        <div class="card-header">
                            <strong>
                                <a href="{{ route('news.show', ['id' => $news->id]) }}">
                                    {{ $news->title }}
                                </a>
                            </strong>
                        </div>
                        <p class="card-text">{!! $news->description !!}</p>
                        <div>Автор: {{ $news->author }}</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Смотреть подробнее</button>
                            </div>
                            <small class="text-muted">{{ now('Europe/Moscow') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h2>Нет новостей</h2>
        @endforelse
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
