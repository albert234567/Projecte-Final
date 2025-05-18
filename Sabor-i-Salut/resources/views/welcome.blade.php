<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor i Salut</title>
    <style>
        :root {
            --primary: #4CAF50;
            --light: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            text-align: center;
            border: 2px solid var(--primary);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background-color: var(--light);
            max-width: 400px;
            width: 90%;
        }

        h1 {
            color: var(--primary);
        }

        .tagline {
            margin: 1rem 0 2rem 0;
            font-size: 1.1rem;
        }

        .buttons a,
        .buttons form button {
            display: block;
            margin: 0.5rem auto;
            background-color: var(--primary);
            color: var(--light);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons a:hover,
        .buttons form button:hover {
            background-color: #388E3C;
        }

        /* Estil per la imatge en el recuadre */
        .image-container {
            width: 100%;
            height: 200px;
            margin-bottom: 1.5rem;
            border: 5px solid var(--primary);
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Imatge enmarcada al dalt -->
        <div class="image-container">
            <img src="{{ asset('img/Sabor_i_Salut2.png') }}" alt="Imatge de projecte">
        </div>

        <h1>Sabor i Salut</h1>
        <p class="tagline">Fer el seguiment de la nutrició d'una manera fàcil i interactiva.</p>

        <div class="buttons">
            @auth
                <a href="{{ route('dashboard') }}">Anar al panell</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Tancar sessió</button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar sessió</a>
                <a href="{{ route('register') }}">Registrar-se</a>
            @endauth
        </div>
    </div>
</body>
</html>
