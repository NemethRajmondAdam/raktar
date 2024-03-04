<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raktár Rendszer</title>
</head>
<body>
    <h1>Üdvözlöm!</h1>

    <?php
        require_once('osztaly.php');

        $tabla = new Osztaly();

        $epuletek = $tabla->getLocal();

        foreach ($epuletek as $epulet) {
            echo '<form method="POST" action="">'
            .'<tr>'
                .'<td> <button  class="" value="'.$epulet['rakatr_id'].'" name="">'.$epulet['epulet'].'</button> </td>'
                . '<td><div style="display: flex">'
                . '</div></td>'
            . '</tr></form>';
        }
    ?>
</body>
</html>