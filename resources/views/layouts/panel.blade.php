<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Daftcode</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>

    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4">Panel użytkownika</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    @if ( \Auth::user()->hasAccessToContactForm() )
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('panel.contact-form')}}">Formularz kontaktowy</a>
                    @endif
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('panel.profile.edit')}}">Edycja profilu</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('panel.profile')}}">Moje dane</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('panel.delete-my-account')}}">Usuń moje konto</a>
                    <a class="py-2 text-dark text-decoration-none" href="{{route('panel.logout')}}">Wyloguj</a>
                </nav>
            </div>

            @if ( Route::currentRouteName() == 'panel.dashboard.index' )
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">Witamy</h1>
                <p class="fs-5 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            @endif
        </header>

        <main>
            @component('components.alert.all')@endcomponent

            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
