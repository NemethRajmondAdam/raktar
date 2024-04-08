<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Főoldal</title>
</head>
<body class = "hatter">
    <?php
        require_once('osztaly.php');

        $tabla = new Osztaly();

    ?>

    <div class="container">
        <div class="half">
            <h2 class="alcim">Adattábla import</h2>
            <p>Válassza ki melyik táblát kívánja importálni</p>
            <?php
                echo "<form method='POST' action=''><select name='import' id='import'>
                            <option value='stores'>Raktárok</option>
                            <option value='row'>Sorok</option>
                            <option value='columns'>Oszlopok</option>
                            <option value='shelves'>Polcok</option>
                            <option value='products'>Termékek</option>
                        </select>
                        <input type='file' name='file' accept='.csv'>";

                echo '<br><button class="button" type="submit" name="import_button">Adatok importálása</button></form>';

                if (isset($_POST['import_button'])) {
                    $name = $_POST['import'];
                    $files= $_POST['file'];
                    $tabla->import($name,$files);
                }
            ?>
        </div>
        <div class="half">
            <h2 class="alcim">Adattábla törlés</h2>
            <p>Válassza ki melyik táblát kívánja törölni</p>
            <?php
                echo "<form method='POST' action=''><select name='delete' id='delete'>
                            <option value='stores'>Raktárok</option>
                            <option value='row'>Sorok</option>
                            <option value='columns'>Oszlopok</option>
                            <option value='shelves'>Polcok</option>
                            <option value='products'>Termékek</option>
                        </select>";
                echo '<br><button class="button" type="submit" name="delete_button">Adatok törlése</button></form>';

                if (isset($_POST['delete_button'])) {
                    $name = $_POST['delete'];
                    $tabla->dropTable($name);
                }
            ?>
        </div>
    </div>
</body>
</html>