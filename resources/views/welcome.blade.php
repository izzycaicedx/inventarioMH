<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH DISTRIBUIDOR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)), url('{{ asset('images/mh.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 50px 60px;
            text-align: center;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
            max-width: 600px;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        p {
            font-size: 1rem;
            line-height: 1.7;
            color: #eaeaea;
            margin-bottom: 30px;
        }

        .btn {
            background: linear-gradient(90deg, #007bff, #00a6ff);
            color: white;
            padding: 12px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.5);
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        <h1>Bienvenido a MH DISTRIBUIDOR</h1>
        <p>
            El éxito de nuestra empresa y la tranquilidad de nuestros clientes dependen
            de tu atención al detalle. Cada registro que haces fortalece la confianza en nuestro servicio.
        </p>
        <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
    </div>
</body>
</html>
