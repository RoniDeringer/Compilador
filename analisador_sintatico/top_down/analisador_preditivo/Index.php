<?php
include __DIR__ . '/css/style.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preditivo</title>
    <center><?php echo '<h1>Analisador Preditivo</h1>'; ?></center>
</head>
<body>

<!-- INTRO -->
    <pre>
        <h2>Copie e cole para teste:</h2>
    funcao(){}<br>
    funcao(variavel){}<br>
    funcao(variavel){}<br>


    não ta aceitando quebras de linha 😞
    </pre>

    <!-- FORMULARIO -->
    <pre>
        <form action="" method="post">
            <label for="entrada">somente letras minisculas!</label>
            <textarea  name="entrada" id="entrada" rows="10" cols="50"></textarea>
            <input type="submit" value="enviar">
        </form>
    </pre>

    <!-- GET FORUMALARIO -->
<?php
if (isset($_POST["entrada"])) {
    $entrada = $_POST["entrada"];

    require_once('AnalisadorLexico.php');
    require_once('AnalisadorPreditivo.php.php');
    $lexico = new src\AnalisadorLexico();

    $lexico->createListToken($entrada);
    ?>

    <!-- LIST TOKEN -->
        <pre>
            <?php
            if ($lexico->getIsAccept()) {
                ?>
            <h2>Lista de Tokens:</h2>
            <table border="1px">

                <tr>
                    <th>TOKEN</th>
                    <th>LEXEMA</th>
                </tr>
                <?php
                foreach ($lexico->getListToken() as $token) {
                    ?>
                        <tr>
                            <td><x>[ </x> <?php echo $token->getNome();  ?><x> ]</x> </td>
                            <td><x>[ </x> <?php echo $token->getLexema();?><x> ]</x> </td>
                        </tr><?php
                }
                ?>
            </table>
                <?php
            } else {
                ?>
                <div style="color: darkred;">                              TOKENS NÃO ACEITO!</div>
            <?php } ?>
        </pre>

    <!-- ANALISE PREDITIVA  -->
                    <?php
} //setado a entrada via post

?>
