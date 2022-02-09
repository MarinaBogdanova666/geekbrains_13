@extends('layouts.admin')
@section('title') Админка @endsection
@section('header')
    <h1 class="h2">Панель администратора</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
@endsection
@section('content')
    <div class="table-responsive" style="overflow-x: hidden">
                @include('inc.message')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Имя пользователя</th>
                        <th>Email</th>
                        <th>Последний вход</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $profile)
                        <tr>
                            <td>{{ $profile->id }}</td>
                            <td>{{ $profile->name }}</td>
                            <td>{{ $profile->email }}</td>
                            <td>{{ $profile->last_login_at }}</td>
                            <td>{{ $profile->is_admin == '1' ? 'Администратор' : 'Пользователь'}}</td>
                            <td>
                                <a href="{{ route('admin.profiles.edit', ['profile' => $profile->id]) }}">Ред.</a> &nbsp;
                                <a href="javascript:;" class="delete" rel="{{ $profile->id }}" style="color:red;">Уд.</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Записей нет</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $users->links() }}
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.querySelectorAll(".delete");
            el.forEach(function (e, k) {
                e.addEventListener('click', function() {
                    const id = e.getAttribute("rel");
                    if (confirm("Подтверждаете удаление пользователя с #ID =" + id + " ?")) {
                        send('/admin/profiles/' + id).then(() => {
                            location.reload();
                        });
                    }
                });
            });
        });
        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
