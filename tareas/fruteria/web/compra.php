<html><head>
<meta charset="UTF-8">
<title>LA FRUTERIA</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head><body>
<H1> La Frutería del siglo XXI</H1>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
<B><br> REALICE SU COMPRA <?= "&nbsp" . htmlspecialchars($_SESSION['cliente']) ?></B><br>
<br><b>Selecciona la fruta: <select name="fruta">
<option value="Fresas">Fresas</option>
<option value="Platanos">Plátanos</option>
<option value="Kiwis">Kiwis</option>
<option value="Manzanas">Manzanas</option>
<option value="Mangos">Mangos</option>
<option value="Naranjas">Naranjas</option>
<option value="Uvas">Uvas</option>
<option value="Limones">Limones</option>
<option value="Peras">Peras</option>
<option value="Sandías">Sandías</option>
</select><br>
Cantidad: <input name="cantidad" type="number" value=0 size=4>
<br><input type="submit" name="accion" value=" Anotar ">
<input type="submit" name="accion" value=" Terminar ">
</form><?= $compraRealizada ?></body></html>