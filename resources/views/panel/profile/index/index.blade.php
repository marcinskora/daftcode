@extends('layouts.panel')
@section('title', 'Dashboard')


@section('content')

<div class="col">
    <ul class="list-group">
        @if ( $user->hasImg() )
        <li class="list-group-item">
            <div class="text-start">
                <div><img src="{{$user->getUrlToImg()}}" /></div>
            </div>
        </li>
        @endif
        <li class="list-group-item">
            <div class="text-start">
                <div class="fw-bold">Imię</div>
                <div>{{$user->name}}</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="text-start">
                <div class="fw-bold">Nazwisko</div>
                <div>{{$user->surname}}</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="text-start">
                <div class="fw-bold">Adres</div>
                <div>{{$user->address}}</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="text-start">
                <div class="fw-bold">E-mail</div>
                <div>{{$user->email}}</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="text-start">
                <div class="fw-bold">Kraj</div>
                <div>{{$user->getCountryName()}}</div>
            </div>
        </li>
    </ul>
</div>
@endsection