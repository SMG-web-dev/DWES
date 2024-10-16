<!DOCTYPE html>
<html>

<head>
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <meta charset="UTF-8">
       <!--  Estilos del alumno Alberto Fernández-->
       <style type="text/css">
              table {
                     font-family: arial;
                     font-size: 35px;
                     font-weight: bold;
                     color: rgb(0, 0, 120);
                     border: 5px double rgb(0, 0, 120);
                     border-collapse: collapse
              }

              #rellena {
                     text-align: center;
                     width: 50px;
                     height: 80px;
                     border: 2px solid rgb(120, 120, 180);
                     background-color: rgb(230, 230, 255);
              }

              #numerito {
                     font-size: 10px;
                     text-align: left;
                     margin-top: -14px;
                     margin-bottom: 14px;
              }

              #vacia {
                     text-align: center;
                     width: 50px;
                     height: 80px;
                     border: 2px solid rgb(120, 120, 180);
                     background-color: rgb(170, 170, 205);
              }
       </style>
       <title>generador de cartones de Bingo 1.0</title>
       <?php
       function createRandomBingo($cols, $rows, $numCount)
       {
              $bingo = [];
              $nums = range(0, $numCount);
              for ($i = 0; $i < $rows; $i++) {
                     $bingo[$i] = array_fill(0, $cols, null);
                     for ($j = 0; $j < $cols; $j++) {
                            if (count($bingo) > 0 && random_int(0, 1))
                                   $bingo[$i][$j] = array_pop($nums);
                            else
                                   $bingo[$i][$j] = "";
                     }
              }
              return $bingo;
       }

       function fillTable($matrix)
       {
              foreach ($matrix as $row) {
                     echo "<tr>";
                     foreach ($row as $value) {

                            $class = $value === "" ? "vacia" : "rellena";
                            $content = $value === "" ? "" : "<div class='numerito'>$value</div>";

                            echo "<td class='$class'>$content</td>";
                     }
                     echo "</tr>";
              }
       }


       ?>
</head>

<body>
       <table>
              <tbody>
                     <?= fillTable(createRandomBingo(9, 3, 10)) ?>
              </tbody>
       </table>
</body>

</html>