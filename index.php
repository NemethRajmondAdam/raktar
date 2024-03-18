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


                echo '<form method="POST" action=""><select class="custom-select" name="raktarokOpciok">';
                foreach ($raktarok as $raktar) {
                    echo '<option value="'.$raktar['id'].'">'.$raktar['name'].'</option>';
                }
                echo '</select><br>';
                //echo '<input class="button" type="submit" name="leltar" value="Leltár Készítés">';
                echo '<button class="button" type="submit" name="leltar">Leltár Készítése</button></form>';
               
            ?>
        </div>
        <div class="half">
            <?php
                if (isset($_POST['leltar'])) {
                    $storeId = $_POST['raktarokOpciok'];

                    $eredmenyek = $tabla->getAllFromProducts($storeId);
                    foreach ($eredmenyek as $eredmeny) {
                        $sorS = $tabla->getRows($eredmeny['id_row']);
                        $oszlopS = $tabla->getColls($eredmeny['id_column']);
                        $polcS = $tabla->getShelves($eredmeny['id_shelf']);

                        echo 'A '.$eredmeny['name'].'-ből található '.$eredmeny['quantity'].' db a(z) '.$sorS.' sor '.$oszlopS.' oszlopjának '.$polcS.' polcán<br>';
                    }
                }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="half">
                <h2 class="alcim">Új adat</h2>
                <?php
                $raktarok = $tabla->getStores();
                $sorok = $tabla->getAllRows();
                $oszlopok = $tabla->getAllCols();
                $polcok = $tabla->getAllShelves();


                echo '<form method="POST" action=""><select class="custom-select" name="raktarokOpciokUj">';
                foreach ($raktarok as $raktar) {
                    echo '<option value="'.$raktar['id'].'">'.$raktar['name'].'</option>';
                }
                echo '</select><br>';
                echo '<select class="custom-select" name="sorok">';
                foreach ($sorok as $sor) {
                    echo '<option value="'.$sor['id'].'">'.$sor['name'].'</option>';
                }
                echo '</select><br>';
                echo '<select class="custom-select" name="oszlopok">';
                foreach ($oszlopok as $oszlop) {
                    echo '<option value="'.$oszlop['id'].'">'.$oszlop['name'].'</option>';
                }
                echo '</select><br>';
                echo '<select class="custom-select" name="polcok">';
                foreach ($polcok as $polc) {
                    echo '<option value="'.$polc['id'].'">'.$polc['name'].'</option>';
                }
                echo '</select><br>';
                echo'<input type="text" id="nev" name="nev" placeholder="Termék neve"><br>
                    <input type="number" id="ar" name="ar" placeholder="Termék ára"><br>
                    <input type="number" id="db" name="db" placeholder="Darabszáma"><br>
                    <input type="number" id="min_db" name="min_db" placeholder="Minimum mennyiség"><br>';
                    
                echo '<button class="button" type="submit" name="newData">Adatok mentése</button></form>';

                if (isset($_POST['newData'])) {
                    $raktar = $_POST['raktarokOpciokUj'];
                    $sor = $_POST['sorok'];
                    $oszlop = $_POST['oszlopok'];
                    $polc = $_POST['polcok'];
                    $nev = $_POST['nev'];
                    $ar = $_POST['ar'];
                    $db = $_POST['db'];
                    $min = $_POST['min_db'];

                    $tabla->new($raktar,$sor,$oszlop,$polc,$nev,$ar,$db,$min);
                }
               
            ?>
        </div>
        <div class="half">
            <h2 class="alcim">Módosítás</h2>
        </div>
        <div class="half">
            <h2 class="alcim">Törlés</h2>
        </div>
    </div>
</body>
</html>