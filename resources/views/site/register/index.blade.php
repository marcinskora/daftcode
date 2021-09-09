@extends('layouts.site')
@section('title', 'Zarejestruj się')


@section('content')
<main class="form-signin">
    @component('components.alert.all')@endcomponent

    <form action="{{ route('site.register.store') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Rejestracja</h1>
        <div class="form-floating">
            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="inputName" placeholder="Jan">
            <label for="inputName">Imię</label>
        </div>
        <div class="form-floating">
            <input type="text" name="surname" value="{{old('surname')}}" class="form-control" id="inputSurname" placeholder="Kowalski">
            <label for="inputSurname">Nazwisko</label>
        </div>
        <div class="form-floating">
            <input type="text" name="address" value="{{old('address')}}" class="form-control" id="inputAddress" placeholder="Warszawa, Piękna 10">
            <label for="inputAddress">Adres</label>
        </div>
        <div class="form-floating">
            <select name="country" class="form-control" id="inputCountry">
                <option value=""></option>
                @foreach ( $countries->all() as $countryCode => $countryName )
                    <option value="{{$countryCode}}" @if ( $countryCode == old('country') ) selected="selected" @endif>{{$countryName}}</option>
                @endforeach
            </select>
            <label for="inputCountry">Kraj</label>
        </div>
        <div class="form-floating">
            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="inputEmail" placeholder="name@example.com">
            <label for="inputEmail">Adres e-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="inputPassword">
            <label for="inputPassword">Hasło</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation">
            <label for="inputPasswordConfirmation">Powtórz hasło</label>
        </div>
        <div class="checkbox mb-3">
            <label>
                Masz już konto? <a href="{{route('site.login')}}">Zaloguj się</a>
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Zarejestruj się</button>
    </form>
</main>
@endsection