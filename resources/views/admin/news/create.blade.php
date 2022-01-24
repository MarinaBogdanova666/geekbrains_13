@extends('layouts.admin')
@section('title')
    Добавить запись @parent
@endsection
@section('header')
    <h1 class="h2">Добавить запись</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
           
        </div>
    </div>
@endsection
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
        <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <div>
        <form method="post" action="{{ route('admin.news.store') }}">
            @csrf
            <div class="form-group" >
                <label for="title">Наименование</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="autor">Автор</label>
                <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor') }}">
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if(old('status') === 'DRAFT') selected @endif>DRAFT</option>
                    <option @if(old('status') === 'ACTIVE') selected @endif>ACTIVE</option>
                    <option @if(old('status') === 'BLOCED') selected @endif>BLOCED</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{!! old('description') !!}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
        </form>    
    </div>
@endsection