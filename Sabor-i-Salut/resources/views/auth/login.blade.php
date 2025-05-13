<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Estils personals */
        :root {
            --primary: #4CAF50;
            --light: #ffffff;
            --bg-color: #f8f8f8;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
        }

        .auth-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: var(--light);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .auth-container h2 {
            text-align: center;
            font-size: 2rem;
            color: var(--primary);
        }

        .auth-container form {
            margin-top: 20px;
        }

        .auth-container .form-group {
            margin-bottom: 15px;
        }

        /* Estils per a les caixes d'entrada */
        .auth-container .form-group input {
            width: 80%;  /* Ajusta l'amplada de les caixes d'entrada a 80% */
            padding: 8px; /* Menys padding per fer les caixes més petites */
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem; /* Redueix la mida de la font */
        }

        .auth-container .form-group label {
            display: block; /* Fa que l'etiqueta es mostri a la línia següent */
            margin-bottom: 5px; /* Afegim una mica d'espai entre l'etiqueta i el input */
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--light);
            padding: 12px 24px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .link-container a {
            text-decoration: none;
            padding: 10px 20px;
            color: white;
            background-color:rgb(32, 57, 93);
            border-radius: 5px;
            margin: 5px;
        }

        .link-container a:hover {
            background-color:rgb(32, 57, 93);
        }

        /* Centra els formularis */
        .form-group {
            margin-bottom: 15px;
            text-align: center;
        }    </style>
</head>
<body>

    <!-- Formulari de Login -->
    <div class="auth-container">
        <h2>Inicia Sessió</h2>
        <form method="POST" action="/login">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contrasenya</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="remember_me">Recorda'm</label>
                <input type="checkbox" id="remember_me" name="remember">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-primary">Iniciar Sessió</button>
            </div>
        </form>

        <div class="link-container">
            <a href="/">⬅️ Anar a la Benvinguda</a>
            <a href="/register">Registrar-se➡️</a>
        </div>
    </div>

</body>
</html>
