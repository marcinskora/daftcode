@extends('layouts.panel')
@section('title', 'Formularz kontaktowy')

@section('content')

<div class="col">
    <form action="{{ route('panel.contact-form.store') }}" method="post">
        @csrf
        <div class="mb-12">
            <label for="textareaMessage" class="form-label">Wiadomość</label>
            <textarea class="form-control" id="textareaMessage" rows="5" name="message">{{old('message')}}</textarea>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Wyślij</button>
    </form>
</div>
@endsection