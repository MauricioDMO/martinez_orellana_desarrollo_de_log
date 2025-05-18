<?php
ini_set('display_error', 1);
ini_set('display_startup_error', 1);
include('inc/funciones.inc.php');
include('secure/ips.php');

$metodo_permitido = "POST";
$archivo = "../logs/log.log";
$dominio_autorizado = "localhost";
$ip = ip_in_ranges($_SERVER["REMOTE_ADDR"], $rango);
$txt_usuario_autorizado = "admin";
$txt_password_autorizado = "admin";

// Verifica si el usuario ha navegado dentro de nuestro sistema
if (array_key_exists("HTTP_REFERER", $_SERVER)) {
  // Verifica que la dirección de origen sea autorizada
  if (strpos($_SERVER["HTTP_REFERER"], $dominio_autorizado)) {
    // El referrer está autorizado, ahora verifica la IP
    if ($ip === true) {
      // IP autorizada, verifica el método de petición
      if ($_SERVER["REQUEST_METHOD"] == $metodo_permitido) {        // Limpieza de valores del formulario
        $valor_campo_usuario = ((array_key_exists("txt_user", $_POST)) ? htmlspecialchars(stripslashes(trim($_POST["txt_user"])), ENT_QUOTES) : "");
        $valor_campo_password = ((array_key_exists("txt_pass", $_POST)) ? htmlspecialchars(stripslashes(trim($_POST["txt_pass"])), ENT_QUOTES) : "");
        // Verifica que los campos no estén vacíos
        if (($valor_campo_usuario != "" || strlen($valor_campo_usuario) > 0) and ($valor_campo_password != "" || strlen($valor_campo_password) > 0)) {
          // Campos tienen valores, validar formato
          $usuario = preg_match('/^[a-zA-Z0-9]{1,10}+$/', $valor_campo_usuario); // Valida usuario: letras y números, 1-10 caracteres
          $password = preg_match('/^[a-zA-Z0-9]{1,10}+$/', $valor_campo_password); // Valida contraseña: letras y números, 1-10 caracteres          // Verifica que los patrones de validación sean correctos
          if ($usuario !== false and $usuario !== 0 and $password !== false and $password !== 0) {
            // Usuario y contraseña tienen formato válido
            if ($valor_campo_usuario === $txt_usuario_autorizado and $valor_campo_password === $txt_password_autorizado) {
              // Credenciales correctas
              echo ("HOLA MUNDO");
              crear_editar_log($archivo, "El cliente inició sesión satisfactoriamente", 1, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
            } else {
              // Credenciales incorrectas
              crear_editar_log($archivo, "Credenciales incorrectas enviadas hacia //$_SERVER[HTTP_HOST]
                            $_SERVER[HTTP_REQUEST_URI]", 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
              header("HTTP/1.1 301 Moved Permanently");
              header("Location: ../?status=7");
            }
          } else {
            // Caracteres no soportados en los campos
            crear_editar_log($archivo, "Envío de datos del formulario con caracteres no soportados", 3, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ../?status=6");
          }
        } else {
          // Campos vacíos
          crear_editar_log($archivo, "Envío de campos vacíos al servidor", 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
          header("HTTP/1.1 301 Moved Permanently");
          header("Location: ../?status=5");
        }
      } else {
        // Método no autorizado
        crear_editar_log($archivo, "Envío de método no autorizado", 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ../?status=4");
      }
    } else {
      // IP no autorizada
      crear_editar_log($archivo, "Dirección IP no autorizada", 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: ../?status=3");
    }
  } else {
    // Referer no autorizado
    crear_editar_log($archivo, "Ha intentado usar un referer no autorizado", 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ../?status=2");
  }
} else {
  // Acceso directo sin pasar por el formulario
  crear_editar_log($archivo, "El usuario ha intentado acceder al sistema de manera incorrecta", 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../?status=1");
}
?>