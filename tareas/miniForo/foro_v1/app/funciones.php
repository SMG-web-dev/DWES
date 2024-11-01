<?php
// usuario con 8 o más caracteres y su contraseña el nombre de usuario al revés
// Hay que evitar en la entrada del comentario y del tema la posible inyección de código.
function usuarioOk($usuario, $contraseña): bool
{
   return ($contraseña == strrev($usuario) && strlen($usuario) >= 8) ? true : false;
}

function inputSanitizer($string): string
{
   return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
function mostFrecuentLetter($comentario): string
{
   return maxFrecuenceLetter(countStringLetters($comentario));
}


function mostFrecuentWord($comentario): string
{
   return maxFrecuenceWord(countStringWords(cleanComent($comentario)));
}


// ============ Métodos auxiliares ============= //

// Limpiar el comentario para poder contar 
function cleanComent($string): array
{
   $string = strtolower($string);
   // delete signos de puntuación
   $string = preg_replace('/[^\w\s]/', '', $string);
   // Dividimos el string en palabras y lo retornamos
   return explode(" ", $string);
}

// Conteo de frecuencia de palabras en array
function countStringWords($words): array
{
   $frecuences = [];
   foreach ($words as $word) {
      if (!empty($word)) {
         if (!isset($frecuences[$word]))
            $frecuences[$word] = 0;
         $frecuences[$word]++;
      }
   }
   return $frecuences;
}

// Encuentra la palabra más repetida
function maxFrecuenceWord($frecuences): string
{
   $maxFrecuence = 0;
   $mostFrecuentWord = '';
   foreach ($frecuences as $word => $frecuence) {
      if ($frecuence > $maxFrecuence) {
         $maxFrecuence = $frecuence;
         $mostFrecuentWord = $word;
      }
   }
   return $mostFrecuentWord;
}

// Conteo de frecuencia de letras en array
function countStringLetters($string): array
{
   $frecuences = [];
   $string = strtolower($string);
   for ($i = 0; $i < strlen($string); $i++) {
      $letter = $string[$i];
      if ($letter >= 'a' && $letter <= 'z') {
         if (!isset($frecuences[$letter]))
            $frecuences[$letter] = 0;
         $frecuences[$letter]++;
      }
   }
   return $frecuences;
}

// Encuentra la letra más repetida 
function maxFrecuenceLetter($arr): string
{
   $maxFrecuence = 0;
   $mostFrecuentLetter = '';
   foreach ($arr as $letter => $frecuence) {
      if ($frecuence > $maxFrecuence) {
         $maxFrecuence = $frecuence;
         $mostFrecuentLetter = $letter;
      }
   }
   return $mostFrecuentLetter;
}
