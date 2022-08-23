<?php
include __DIR__ . '/css/style.php';
echo '<h1>Análise léxica</h1>';

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Analise Lexica</title>
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
        require_once('Compilador.php');
        $entrada = $_POST["entrada"];
        $teste = new src\Compilador($entrada);

        ?>
    <pre>
        <?php
        if (!$teste->principal()) {
            ?>

            <table border="1px">

                <tr>
                    <th>TOKEN</th>
                    <th>LEXEMA</th>
                </tr>

            <?php
            foreach ($teste->getToken() as $token) {
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

    </body>
</html>