@extends('layouts.admin')
@section('title')
    Редактировать запись @parent
@endsection
@section('header')
    <h1 class="h2">Редактировать запись</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    <div>
        @include('inc.message')
        <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group" >
                <label for="category_id">Категория</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                        @if($category->id === $news->category_id) selected @endif> {{ $category->title }}</option>
                    @endforeach
                </select>
                @error('category_id') <strong style="color: red;">{{ $message }}</strong> @enderror
            </div>
            <div class="form-group" >
                <label for="title">Наименование</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}">
                @error('title') <strong style="color: red;">{{ $message }}</strong> @enderror
            </div>
            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $news->author }}">
                @error('author') <strong style="color: red;">{{ $message }}</strong> @enderror
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if($news->status === 'DRAFT') selected @endif>DRAFT</option>
                    <option @if($news->status === 'ACTIVE') selected @endif>ACTIVE</option>
                    <option @if($news->status === 'BLOCKED') selected @endif>BLOCKED</option>
                </select>
            </div>
            <div class="form-group">
                <div>
                    <label for="image">Изображение</label>
                </div>
                @if($news->image)
                    <img id="preview" src="{{ Storage::disk('public')->url($news->image) }}" style="width: 200px;">&nbsp;
                    <a href="javascript:;" class="delete" rel="{{ $news->id }}">[X]</a>
                @endif
                <input type="file" class="form-control" id="image" name="image" value="{{ $news->image }}">
                {{--      Костыль для удаления image из базы          --}}
                <input type="hidden" name="imageRemove" value=false>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{!! $news->description !!}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success" style="float: right;">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.querySelectorAll(".delete");
            el.forEach(function (e, k) {
                e.addEventListener('click', function() {
                    const input = document.querySelector('input[name=imageRemove]');
                    if (!input) return;

                    if (!confirm('Вы действительно хотите удалить изображение?')) return;

                    input.value = true;
                    const preview = document.getElementById('preview');
                    if (!preview) return;

                    preview.src = '';
                });
            });
        });
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
