<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre els teus clients</title>
    <style>
        :root {
            --primary: #4CAF50;
            --light: #ffffff;
            --bg-color: #ffffff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .auth-container {
            text-align: center;
            border: 2px solid var(--primary);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: var(--light);
            max-width: 400px;
            width: 90%;
        }

        .auth-container h2 {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .auth-container form {
            margin-top: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--light);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        .link-container {
            text-align: center;
            margin-top: 1.5rem;
        }

        .link-container a {
            text-decoration: none;
            display: inline-block;
            padding: 0.75rem 1.5rem;
            color: white;
            background-color: rgb(238, 118, 26);
            border-radius: 10px;
            margin: 5px auto;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .link-container a:hover {
            background-color: rgb(200, 100, 20);
        }

    </style>
</head>
<body>

    <!-- Formulari de Registre -->
    <div class="auth-container">
        <h2>Registra els teus clients</h2>
        <form method="POST" action="{{ route('clients.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contrasenya</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <input type="hidden" name="rol" value="client">

            <div class="form-group">
                <button type="submit" class="btn-primary">Registrar client</button>
            </div>
        </form>

        <!-- Enllaços per a altres pàgines -->
        <div class="link-container">
            <a href="{{ url('/') }}">⬅️ Anar a la Benvinguda</a>
            <a href="{{ url('/login') }}">Inicia Sessió ➡️</a>
        </div>
    </div>

</body>
</html>
