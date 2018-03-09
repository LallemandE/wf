/*
Cette version n'utilise pas l'architecture de service et de controller telle que mise en
place le 09/03/2018 en fin de matinée (avec classe DBConnection et init.php).

Par contre, elle "escape" la donnée fournie par l'utilisateur pour éviter une attaque par injection de SQL.

L'escape se fait en indiquant un    :identifiant      dans l'instruction SQL à chaque fois qu'un argument est nécessaire.

On  fait le bindParam ensuite en indiquant l'     identifiant      et la variable qu'il faut y associer.
*/


<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Get account info</title>
	</head>
	<body>

<?php
    $displayAccountUserName = $_GET['username'] ?? null;

    if (! $displayAccountUserName){
        ?>
        <div>
        	<p>To be displayed, this page requires a valid numeric username as argument</p>
        </div>
        <?php
    } else {
        try {
            $connection = new PDO('mysql:host=localhost;dbname=register', 'root', '');
        } catch (PDOException $exception) {
            http_response_code(500); // cela va indiquer le code retour 500 = serveur error
            echo 'A problem occured, contact support';
            exit (1);
        }

				// si on ne protège pas le contenu des variables, on pourrait avoir une attaque par injection !!!!!
				// on doit "escaper"
				// mysqli est un ancien driver et il avait une méthode real escaper
				// avec PDO, on va avoir un "prepare"

				// dans l'instruction suivante, on indique avec le : devant username que c'est un paramètre de la préparation du
				// statement.

        $mySQLInstruction = 'SELECT * FROM user where username = :username';

				$statement = $connection->prepare($mySQLInstruction);

				// une fois que l'on a injecté l'instruction sql avec ses :nom_de_param pour indiquer les endroits où vont
				// les paramètres, on va lier les paramètres avec les variables correspondantes qui seront 'escapées'
				$statement->bindParam('username', $displayAccountUserName);





				$statement->execute();


        // si j'ai une erreur dans mon instruction SQL, PDOResult n'est pas l'object que je cherche mais
        // un boolean

        if (! $statement) {
            echo "Erreur dans mon instruction SQL :<br/><br/> $mySQLInstruction<br>";
            return;
        }

        $resultArray = $statement->fetchAll();
        if (count($resultArray)>0){
            foreach ($resultArray as $resultLine){
								echo "<p>id = ". $resultLine['id'] . "</p>";
                echo "<p>username = ". $resultLine['username'] . "</p>";
                echo "<p>password = ". $resultLine['password'] . "</p>";
            }
        } else {
                ?>
                <div>
        			<p>Unknow username !</p>
        		</div>
                <?php
            }

        }
        ?>
</body>
</html>
