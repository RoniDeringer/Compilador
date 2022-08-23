<?php
include __DIR__ . '/css/style.php';
echo '<h1>Análise Sintática - Descida Recursiva</h1>';

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Descida Recursiva</title>
    </head>
    <body>
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


        require_once('AnaliseLexica.php');
        $analisadorLexico = new src\AnaliseLexica($entrada);

        require_once('DescidaRecursiva.php');
        $analisadorSintatico = new src\DescidaRecursiva();


        ?>
    <pre>
        <?php
        if (!$analisadorLexico->principal()) {
            ?>

            <table border="1px">

                <tr>
                    <th>TOKEN</th>
                    <th>LEXEMA</th>
                </tr>

            <?php
            foreach ($analisadorLexico->getToken() as $token) {
                foreach ($token as $key => $value) {
                    ?>
                            <tr>
                                <td><x>[ </x> <?php echo $key;  ?><x> ]</x> </td>
                                <td><x>[ </x> <?php echo $value;?><x> ]</x> </td>
                            </tr><?php
                }
            }
            ?></table><?php
        }
    }
    ?>

    </pre>
    <pre>
        <?php
            $analisadorSintatico->teste();
        ?>
    </pre>

    </body>
</html>
