<?php
function usuarioOk($usuario, $contraseña): bool
{
   return (
      ($usuario == "Manolo" && $contraseña == "soyManolo") ||
      ($usuario == "Joselu" && $contraseña == "soyJoselu") ||
      ($usuario == "Pepelu" && $contraseña == "soyPepelu")
   ) ? true : false;
}
