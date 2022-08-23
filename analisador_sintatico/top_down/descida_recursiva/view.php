<?php
include __DIR__ . '/css/style.php';
echo '<h1>Análise Sintática - Descida Recursiva</h1>';

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Descida Recursiva</title>
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
        require_once('AnaliseLexica.php');
        require_once('DescidaRecursiva.php');
        $entrada = $_POST["entrada"];

        $lexica = new src\AnaliseLexica($entrada);
        $sintatica = new src\DescidaRecursiva();

        ?>
    <pre>
        <?php
        echo '<h2>Lista de Tokens</h2>';
        if (!$lexica->principal()) {
            ?>

            <table border="1px">

                <tr>
                    <th>TOKEN</th>
                    <th>LEXEMA</th>
                </tr>

            <?php
            foreach ($lexica->getToken() as $token) {
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
     echo '<h2>Descida Recursiva</h2>';
    ?>
</pre>

    </body>
</html>