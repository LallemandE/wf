<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Get account info</title>
	</head>
	<body>
	
<?php
    $displayAccountId = $_GET['id'] ?? null;
    
    if (! $displayAccountId || ! is_numeric($displayAccountId)){
        ?>
        <div>
        	<p>To be displayed, this page requires a valid numeric id as argument</p>
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
        
        $mySQLInstruction = "SELECT username, password FROM user where id = ". $displayAccountId;
        
        // quand on exécute une requête qui fait des modifications en base,
        // c'est la méthode "exec" que je vais utiliser et le résultat sera un nombre de lignes
        // modifiées
        
        // pour récupérer des données qu'une base de données, c'est la méthode "query" que je vais utiliser
        // le résultat de cette méthode est un OBJET sur lequel je peux exécuter la méthode
        // - fetchAll qui va me retourner un array avec TOUTES les valeurs qu'il a pu lire ou
        // - fetch qui va me retourner la prochaine valeur disponible.
        
        // Si j'utilise fetchAll, je dois parcourir mon tableau pour afficher son contenu.
        
        
        $PDOResult = $connection->query($mySQLInstruction);
        
        // si j'ai une erreur dans mon instruction SQL, PDOResult n'est pas l'object que je cherche mais
        // un boolean
        
        if (! $PDOResult) {
            echo "Erreur dans mon instruction SQL :<br/><br/> $mySQLInstruction<br>";
            return;
        }
        
        $resultArray = $PDOResult->fetchAll();
        if (count($resultArray)>0){
            foreach ($resultArray as $resultLine){
                echo "<p>username = ". $resultLine['username'] . "</p>";
                echo "<p>password = ". $resultLine['password'] . "</p>";
            }
        } else {
                ?>
                <div>
        			<p>Unknow user ID !</p>
        		</div>
                <?php 
            }

        }
        ?>
</body>
</html>