<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            /* background-image: url("{{ asset('./public/assets/images/maritimmudalogo.png') }}");
            background-size: cover;
            background-position: center; */
            background-color: rgba(173, 216, 230,.4);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Add blur effect to the background image */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px);
            z-index: -1;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.9);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 19px rgba(0, 0, 0, 0.5);
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .btn-custom {
            background-color: #0077be;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Login</h2>

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
