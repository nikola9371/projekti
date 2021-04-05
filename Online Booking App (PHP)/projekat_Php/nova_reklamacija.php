<?php
    require('php/login_config.php');
 
 if(!isset($_SESSION['userID'])){
    header("Location:login-form.php");
    exit();
 }
 else{
    $userData=getUserData($_SESSION['userID']);
 }
    
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Nova Reklamacija</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="strana0.css">
	<link rel="stylesheet" type="text/css" href="reklamacije.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
             include "php/reklamacije.php";
        
            $reklamacija=new Reklamacije();
            if(isset($_POST["new-reclamation-confirm"])){
                $reklamacija->azuriraj_reklamacije(mysqli_real_escape_string($GLOBALS['link'],$_POST["imePrezime"]),mysqli_real_escape_string($GLOBALS['link'],$_POST["datum"]), mysqli_real_escape_string($GLOBALS['link'],$_POST["pol"]), mysqli_real_escape_string($GLOBALS['link'],$_POST["idNarudz"]));
                $statement1="Uspešno uneta nova reklamacija";
            }
        
        ?>
        <fieldset>
            <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
                <table id="tabela" width="50%" align="center">
                    <th colspan="2">
                        <h1>Nova reklamacija:</h1>
                            <?php if(isset($statement1)){ ?>
                           <span><?php echo "<font color='black'>".$statement1."</font>"; ?></span><br>
                            <?php } ?>
                    </th>
                    <tr>
                        <td class="labele" >
                            <label>Broj Narudžbine</label>
                        </td>
                        <td>
                            <input type="text" name="idNarudz" placeholder="broj narudžbine.." required>
                        </td>
                    </tr>
                    <tr>
                        <td class="labele">
                            <label>Ime i prezime: </label>
                        </td>
                        <td>
                            <input id="ime" type="text" name="imePrezime" placeholder="ime i prezime..." required>
                        </td>
                    </tr>
                    <tr>
                        <td class="labele">
                            <label>Datum rođenja:</label>
                        </td>
                        <td>
                            <input type="date" name="datum">
                        </td>
                    </tr>
                    <tr>
                        <td class="labele">
                            <label>Pol:</label>
                        </td>
                        <td>
                            <select name="pol">
                                <option value="muski">muški</option>
                                <option value="zenski">ženski</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="labele">
                            <input class="button" type="submit" name="new-reclamation-confirm" value="potvrdi">
                            <input class="button" type="reset" value="počisti">
                        </td>
                        <td>
                            <a id="logout" href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span>Odjavi me</a>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>
