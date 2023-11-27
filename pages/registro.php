<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Fútbol</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/registro.css">
    </head>
    <body>
        <div class="contenedor">
            <main class="main">
                <h1 class="main__h1">REGÍSTRATE</h1>
                <form class="main__form" action="../index.php" method="post">
                    <div class="d-flex mb-3 mt-3">
                        <div class="form-group right">
                            <label class="form__label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                      </div>
                      <div class="form-group">
                        <label class="form__label">Apellido</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                      </div>
                    </div>
                    
                    <div class="d-flex mb-3 mt-3">
                        <div class="form-group right">
                          <label class="form__label">DNI:</label>
                          <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="form-group mb-3">
                          <label class="form__label">Dorsal:</label>
                          <input type="text" class="form-control" id="dorsal" name="dorsal" required>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3 mt-3">
                        <div class="form-group right">
                          <label class="form__label">Usuario:</label>
                          <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>                   
                        <div class="form-group mb-3">
                          <label class="form__label">Correo electrónico:</label>
                          <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form__label">Contraseña:</label>
                      <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-success form__button mb-3">Registrarse</button>
                  </form>
            </main>
        </div>
    </body>
</html>