<?php
include_once __DIR__.'/init.php'; ?>

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

            $connection = Service\DBConnector::getConnection();


        } catch (PDOException $exception) {
            http_response_code(500); // cela va indiquer le code retour 500 = serveur error
            echo 'A problem occured, contact support';
            exit (1);
        }

        // Dans l'instruction suivante, on travaille avec la préparation de SQL statement qui permet
        // d'escaper les variables reçues de l'utilisateur => cela permet d'éviter les attaques
        // par injection de SQL.

        $mySQLInstruction = "SELECT * FROM user where username = :username";

        $mySQLStatement = $connection->prepare($mySQLInstruction);

        $mySQLStatement->bindParam('username', $displayAccountUserName, PDO::PARAM_STR);

        $mySQLStatement->execute();

        $connection->query($mySQLInstruction);

        // si j'ai une erreur dans mon instruction SQL, PDOResult n'est pas l'object que je cherche mais
        // un boolean

        if (! $mySQLStatement) {
            echo "Erreur dans mon instruction SQL :<br/><br/> $mySQLInstruction<br>";
            return;
        }

        $resultArray = $mySQLStatement->fetchAll();
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
