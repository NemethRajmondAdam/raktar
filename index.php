<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Raktár Rendszer</title>
</head>
<body class="hatter">
    <header>
        <div class="cim"><h1>Üdvözlöm!</h1></div>
    </header>
    <?php
        require_once('osztaly.php');

        $tabla = new Osztaly();

    ?>
    <div class="container">
        <div class="half">
            <?php
                $epuletek = $tabla->getStores();

                foreach ($epuletek as $epulet) {
                    echo '<form method="POST" action="">'
                    .'<tr>'
                        .'<td> <button  class="button" value="'.$epulet['id'].'" name="store_buttons">'.$epulet['name'].'</button> </td>'
                        . '<td><div style="display: flex">'
                        . '</div></td>'
                    . '</tr></form>';
                }
            ?>
        </div>
        <div class="half">
            <?php
            if (isset($_POST['store_buttons'])) {
                $id = $_POST['store_buttons'];
                $termekek = $tabla->getProductsById($id);

                if (!empty($termekek)) {
                    $sv = 0;
                    foreach ($termekek as $termek)
                    {
                        if ($sv<1) {
                            $store = $tabla->getStoreById($termek['id_store']);
                            echo '<td class="alcim">'.$store.' </td><br>';

                        } 
                            echo '<form method="POST" action="">'
                            .'<tr>'
                                //.'<td class="cim">'.$store.' </td>'
                                .'<td>'.$termek['name'].' </td>'
                                .'<td>'.$termek['price'].'FT </td>'
                                .'<td>'.$termek['quantity'].'db </td>'
                                . '<td><div style="display: flex">'
                                . '</div></td>'
                            . '</tr></form>';

                        $sv+=1;
                            
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class ="container">
        <div class="half">
            <h2 class="alcim">Leltár készítő</h2>
            <?php
                $raktarok = $tabla->getStores();

                echo '<div class="custom-select"><select>';
                foreach ($raktarok as $raktar) {
                    echo '<option value="'.$raktar['id'].'">'.$raktar['name'].'</option>';
                }
                echo '</select><br>';
                echo '<button  class="button" value="" name="leltar">Leltár készítése</button></div>';
            ?>
        </div>
    </div>
</body>
</html>