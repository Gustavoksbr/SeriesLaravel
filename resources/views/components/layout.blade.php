<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    @vite('resources/js/app.js')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>
            @auth
                <a href="{{ route('logout') }}">Sair</a>
            @endauth
            @guest
                @if (!isset($login))
                    <a href="{{ route('login') }}">Entrar</a>
                @endif
            @endguest
        </div>
    </nav>
    <main class="container">
        <h1>{{$title}}</h1>
        @isset($mensagemSucesso)
            <div class="alert alert-success">
                {{$mensagemSucesso}}
            </div>
        @endisset
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{$slot}}
    </main>
</body>

</html>