<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión: Mauricio Daniel Martínez Orellana</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/fontawesome/css/all.css">
  <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/sweetalert.all.js"></script>
  <script type="text/javascript" src="fonts/fontawesome/js/all.js"></script>
</head>

<body>
  <div class="alert alert-warning" role="alert">
    <b>

    </b>
  </div>

  <div class="form-row">
    <div class="form-group col-md-5 text-center">
      <img src="media/logo/logo_corporativo.png" alt="" id="img" class="mx-auto d-block" width="65%" height="auto">
    </div>
    <div class="form-group col-md-5 text-center ml-4 mr-4 justify-content align-self-center">
      <h1>Diseñando Estrategias para la Recuperación y Mitigación de Bases de Datos</h1>
      <form name="frm_iniciar_sesion" id="frm_iniciar_sesion" action="core/process.php" method="post">
        <div class="form-group">
          <label for="txt_pass">Usuario:</label>
          <input type="text" class="form-control" id="txt_user" name="txt_user" aria-describedby="text_userHelp"
            maxlength="10" placeholder="Ingrese su contraseña" required>
          <small id="text_userHelp" class="form-text text-muted">Digite su Usuario (Obligatorio)</small>
        </div>

        <div class="form-group">
          <label for="txt_pass">Contraseña:</label>
          <input type="password" class="form-control" id="txt_pass" name="txt_pass" aria-describedby="text_passHelp"
            maxlength="10" placeholder="Ingrese su contraseña" required>
          <small id="text_passHelp" class="form-text text-muted">Digite su Contraseña (Obligatorio)</small>
        </div>
      </form>

    </div>
  </div>
</body>

</html>