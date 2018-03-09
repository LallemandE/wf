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



        // quand on exécute une requête qui fait des modifications en base,
        // c'est la méthode "exec" que je vais utiliser et le résultat sera un nombre de lignes
        // modifiées

        // pour récupérer des données qu'une base de données, c'est la méthode "query" que je vais utiliser
        // le résultat de cette méthode est un OBJET sur lequel je peux exécuter la méthode
        // - fetchAll qui va me retourner un array avec TOUTES les valeurs qu'il a pu lire ou
        // - fetch qui va me retourner la prochaine valeur disponible.

        // Si j'utilise fetchAll, je dois parcourir mon tableau pour afficher son contenu.

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
