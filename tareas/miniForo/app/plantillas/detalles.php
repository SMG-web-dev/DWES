<div>
    <b> Detalles:</b><br>
    <table>
        <tr>
            <td>Longitud: </td>
            <td><?= strlen(inputSanitizer($_REQUEST['comentario'])) ?></td>
        </tr>
        <tr>
            <td>Nº de palabras: </td>
            <td><?= str_word_count(inputSanitizer($_REQUEST['comentario'])) ?></td>
        </tr>
        <tr>
            <td>Letra + repetida: </td>
            <td><?= mostFrecuentLetter(inputSanitizer($_REQUEST['comentario'])) ?></td>
        </tr>
        <tr>
            <td>Palabra + repetida:</td>
            <td><?= mostFrecuentWord(inputSanitizer($_REQUEST['comentario'])) ?></td>
        </tr>
    </table>
</div>