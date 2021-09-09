@extends('layouts.site')
@section('title', 'Logowanie')


@section('content')
<main class="form-signin">
    @component('components.alert.all')@endcomponent

    <form action="{{ route('site.login.store') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Logowanie</h1>
        <div class="form-floating">
            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Adres e-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Hasło</label>
        </div>
        <div class="checkbox mb-3">
            <label>
                Nie masz jeszcze konta? <a href="{{route('site.register')}}">Zarejestruj się</a>
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Zaloguj</button>
    </form>
</main>
@endsection