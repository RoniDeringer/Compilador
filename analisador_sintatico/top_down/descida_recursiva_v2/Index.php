<?php
include __DIR__ . '/css/style.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>descidaRecursiva</title>
    <center><?php echo '<h1>Análise Sintática - Descida Recursiva</h1>'; ?></center>
</head>
<body>

<!-- INTRO -->
    <pre>
        <h2>Copie e cole para teste:</h2>
    funcao(){}


    ARRUMAR:
    fazer funcionar de fato = adicionar o espaço
    front = ajustar 2 colunas
    gramatica = remover a letras
    adicionar as transações no array de corpo1
    resolver recursao em listaParametro

    cuidar com o espaço
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
    require_once('AnalisadorSintatico.php');
    $lexico = new src\AnalisadorLexico();
    $sintatico = new src\AnalisadorSintatico();

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

    <!-- ANALISE SINTATICA  -->
    <pre>
        <?php
                $sintatico->start($lexico);


        if ($sintatico->getIsAcceptSintatico()) {
            ?>
                    <div style="color: darkgreen;">                              GRAMÁTICA ACEITA!</div>
        <?php } else { ?>
                    <div style="color: darkred;">                              GRAMÁTICA NÃO ACEITA!</div>
                <?php
        }
        ?>
    </pre>
    <pre>
            <h2>Listagem de transações da Gramática:</h2>
           <?php
            foreach ($sintatico->listTransicaoGramatica as $transacao) {
                ?>
                <tr>
    <td><x>[ </x> <?php echo $transacao;  ?><x> ]</x> </td>
                </tr><?php
            }
            ?>
    </pre>
                    <?php
} //setado a entrada via post

?>
