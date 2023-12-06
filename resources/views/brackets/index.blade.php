<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brackets Format Validator</title>
    <link rel="stylesheet" href="{{ url('assets/css/bracket.css')}}" />
</head>
<body>
    <header>
        <h1>Validator of brackets format</h1>
    </header>
    <main>
        <div class="bracket-form">
            <form action="{{route('brackets.validator')}}" method="POST">
                @csrf
                <label for="brackets">Brackets</label>
                <input type="text" id="brackets" name="brackets" value="" placeholder="Please, input the brackets" />
                <button type="submit">Validate</button>

                @if($errors->any())
                    <div class="error">
                        <ul>
                            <h5>
                                <i class="icom fas fa-ban">Something is wrong</i>                            
                            </h5>
                            @foreach($errors->all() as $error)
                                <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="success">
                        {{session('success')}}
                    </div>
                @endif
        
                @if(session('warning'))
                    <div class="warning">
                        {{session('warning')}}
                    </div>
                @endif
                <div class="details">
                    <p><b>Dizemos que uma sequência de colchetes é válida se as seguintes condições forem atendidas:</b></p>
                    <ul>
                        <li>Não contém colchetes sem correspondência.</li>
                        <li>O subconjunto de colchetes dentro dos limites de um par de colchetes correspondente é também um par de colchetes.</li>
                        <li></li>
                    </ul>
                    <p><b>Exemplos:</b></p>
                    <ul>
                        <li>(){}[] é válido</li>
                        <li>[{()}](){} é válido</li>
                        <li>[]{() não é válido</li>
                        <li>[{)] não é válido</li>
                    </ul>
                </div>
            </form>
           
        </div>
    </main>
    <footer>
        <h3>Exercise 1</h3>
    </footer>
</body>
</html>