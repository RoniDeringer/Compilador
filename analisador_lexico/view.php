<?php
include __DIR__ . '/css/style.php';
echo '<h1>Análise léxica</h1>';

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        <title>Analise Lexica</title>
    </head>
    <body>
        <pre>
            <form action="" method="post">
                <label for="entrada">somente letras minisculas!</label>
                <textarea  name="entrada" id="entrada" rows="8"></textarea>
                <input type="submit" value="enviar">
            </form>
        </pre>
    <?php
        if (isset($_POST["entrada"])) {
            require_once('Compilador.php');
            $entrada = $_POST["entrada"];
            $teste = new Compilador($entrada);
        }
    ?>
    <pre>
        <?php
            if(!$teste->principal()){ 
        ?>
        
            <table border="1">
                    
                <tr>
                    <th>token</th>
                    <th>lexema</th>
                </tr>
                    
                <?php
                    foreach ($teste->getToken() as $token){
                        foreach ($token as $key => $value){
                            ?>
                            <tr>
                                <td> <?php echo('[ '.$key.' ]');  ?> </td>
                                <td> <?php echo('[ '.$value.' ]');?> </td>
                                <br>
                            </tr><?php
                        }
                    }
                    ?></table><?php
                }
                ?>
            
    </pre>

    </body>
</html>