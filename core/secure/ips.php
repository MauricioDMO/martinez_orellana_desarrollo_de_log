<?php
$rango = array(
  "127.0.0.1/32",             // Permite únicamente la dirección localhost
  "192.168.1.0/24",           // Permite todos los hosts de la red 192.168.1.*
  "10.0.0.*",                 // Permite todos los hosts de la red 10.0.0.x
  "172.16.10.1-172.16.10.50", // Permite el rango de IP específico
  // "*.*.*.*",             // Permite cualquier dirección IP
);
?>