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
            </form>
        </div>
    </main>
    <footer>
        <h3>Exercise 1</h3>
    </footer>
</body>
</html>