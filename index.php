<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="body">
        <div class="contenedor">
            <header class="header">
                <h1 class="header__title">BIENVENIDO A LA PÁGINA DEL EQUIPO</h1>   
            </header>
            <main class="main">
                <h2 class="main__title">
                    INICIA SESION
                </h2>
                <form method="post" action="./pages/calendario.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Usuario</label>
                        <input name="user" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="d-flex">
                        <p>¿No estás registrado?</p>
                        <a href="./pages/registro.php">Registate</a>
                    </div>
                    <button class="boton bg-success" type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </main>
        </div>  
    </body>
</html>