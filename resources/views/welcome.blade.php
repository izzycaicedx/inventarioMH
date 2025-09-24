<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH DISTRIBUDOR</title>
    <style>
        body {
            background-image: url('{{ asset('images/mh.png') }}');
            background-size: cover;
            background-position: center; 
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
        }

        .company-summary h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .company-summary p {
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        .login-box a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .login-box a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="company-summary">
            <h1>Bienvenido a MH DISTRIBUDOR</h1>
            <p>
                El éxito de nuestra empresa y la tranquilidad de nuestros clientes dependen 
                de tu atención al detalle. Con cada registro que haces, estás construyendo la base de nuestra confianza.
            </p>
        </div>
        <div class="login-box">
            <p>Para acceder al inventario.</p>
            <a href="{{ route('login') }}">Iniciar Sesión</a>
        </div>
    </div>
</body>
</html>
