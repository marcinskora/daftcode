@if ($errors->any())
<div class="alert alert-danger" role="alert">
    Coś poszło nie tak!<br/>
    @foreach ($errors->all() as $error)
        {{ $error }}<br />
    @endforeach
</div>
@endif