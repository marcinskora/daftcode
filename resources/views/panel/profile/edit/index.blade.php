@extends('layouts.panel')
@section('title', 'Dashboard')


@section('content')

<div class="col">
    <form action="{{ route('panel.profile.edit.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-floating">
            <input type="text" name="name" value="{{old('name',$user->name)}}" class="form-control" id="inputName" placeholder="Jan">
            <label for="inputName">Imię</label>
        </div>
        <div class="form-floating">
            <input type="text" name="surname" value="{{old('surname',$user->surname)}}" class="form-control" id="inputSurname" placeholder="Kowalski">
            <label for="inputSurname">Nazwisko</label>
        </div>
        <div class="form-floating">
            <input type="text" name="address" value="{{old('address',$user->address)}}" class="form-control" id="inputAddress" placeholder="Warszawa, Piękna 10">
            <label for="inputAddress">Adres</label>
        </div>
        <div class="form-floating">
            <select name="country" class="form-control" id="selectCountry">
                <option value=""></option>
                @foreach ( $countries->all() as $countryCode => $countryName )
                <option value="{{$countryCode}}" @if ( $countryCode == old('country',$user->country) ) selected="selected" @endif>{{$countryName}}</option>
                @endforeach
            </select>
            <label for="selectCountry">Kraj</label>
        </div>
        <div class="form-floating">
            <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control" id="inputEmail" placeholder="name@example.com">
            <label for="inputEmail">Adres e-mail</label>
        </div>
        <div class="form-floating" id="inputImg" @if ( !$user->hasAccessToUploadProfileFile(old('country',$user->country)) ) style="display:none;" @endif>
            <input type="file" name="img" class="form-control">
            <label for="inputImg">Zdjęcie profilowe</label>
            <div id="emailHelp" class="form-text">Plik gif, png, jpg o maksymalnych rozmiarach 200px x 200px</div>
            @if ( $user->hasImg() )
                <div><img src="{{$user->getUrlToImg()}}" /></div>
            @endif
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="inputPassword">
            <label for="inputPassword">Nowe hasło</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation">
            <label for="inputPasswordConfirmation">Powtórz nowe hasło</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Zapisz</button>
    </form>
</div>


<script>
    document.getElementById("selectCountry").onchange = function() {
        var countries = '{{implode(",",$user->getCountryCodesToUploadProfileFile())}}';
        countries = countries.split(",");
        if ( countries.indexOf(this.value) != -1 ) {
            document.getElementById("inputImg").style.display = "block";
        } else {
            document.getElementById("inputImg").style.display = "none";
        }
    };
</script>
@endsection