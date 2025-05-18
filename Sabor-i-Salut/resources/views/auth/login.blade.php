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
            margin-bottom: 1.5rem;
        }

        .auth-container form {
            margin-top: 1.5rem;
        }

        .auth-container .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .auth-container .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
            color: #333;
        }

        .auth-container .form-group input,
        .auth-container .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            box-sizing: border-box;
            margin-top: 5px;
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
            margin-top: 1.5rem;
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
            margin: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .link-container a:hover {
            background-color: rgb(200, 100, 20);
        }
        </style>
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
                <button type="submit" class="btn-primary">Iniciar Sessió</button>
            </div>
        </form>

            <br>

        <div class="link-container">
            <a href="/">⬅️ Anar a la Benvinguda</a>
            <a href="/register">Registrar-se➡️</a>
        </div>
    </div>

</body>
</html>
