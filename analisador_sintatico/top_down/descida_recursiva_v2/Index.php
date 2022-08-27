<?php
include __DIR__ . '/css/style.php';
echo '<h1>Análise Sintática - Descida Recursiva</h1>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>descidaRecursiva</title>
</head>
<body>
    <pre>
        <h2>Linguagem esperada:</h2>
        funcao nome (variavel){
            tipo variavel = valor
            if(valor > numero){
                imprime (valor)
            }
        }
        chama nome()
    </pre>

    <pre>
        <form action="" method="post">
            <label for="entrada">somente letras minisculas!</label>
            <textarea  name="entrada" id="entrada" rows="10" cols="50"></textarea>
            <input type="submit" value="enviar">
        </form>
    </pre>
<?php
if (isset($_POST["entrada"])) {
    $entrada = $_POST["entrada"];

    require_once('AnalisadorLexico.php');
    require_once('AnalisadorSintatico.php');
    $lexico = new src\AnalisadorLexico();
    $sintatico = new src\AnalisadorSintatico($lexico);

    $lexico->principal($entrada);
    ?>
        <pre>
            <table border="1px">

                <tr>
                    <th>TOKEN</th>
                    <th>LEXEMA</th>
                </tr>

    <?php
    foreach ($lexico->getListToken() as $token) {
        foreach ($token as $key => $value) {
            ?>
                            <tr>
                                <td><x>[ </x> <?php echo $key;  ?><x> ]</x> </td>
                                <td><x>[ </x> <?php echo $value;?><x> ]</x> </td>
                            </tr><?php
        }
    }
    ?></table>
        </pre>

<pre>
    <?php
    if ($lexico->getIsAccept()) {
        echo '<br>';
        echo "codigo aceito";
    } else {
        echo '<br>';
        echo "codigo invalido";
    }
}
?>
</pre>
