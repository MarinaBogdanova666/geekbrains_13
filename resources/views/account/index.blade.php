<h2>Добро пожаловать, {{ Auth::user()->name }}</h2>
<br>
@if(Auth::user()->is_admin)
    <a href="{{ route('admin.index') }}" style="color: red;">Перейти в Админку</a>
    <br>
@endif
@if(Auth::user()->avatar)
    <img src="{{ Auth::user()->avatar }}" style="width: 300px">
@endif
<a href="{{ route('account.logout') }}" style="color: #0a53be;">Выход</a>


