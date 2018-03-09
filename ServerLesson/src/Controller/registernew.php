<?php

include_once __DIR__.'/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? null;
    $password_1 = $_POST['password_1'] ?? null;
    $password_2 = $_POST['password_2'] ?? null;

    echo 'Validate data<br>';


    $usernameSuccess = (is_string($username) && strlen($username) > 2);
    $passwordSuccess = ($password_1 == $password_2 && strlen($password_1) > 7);


    if ($usernameSuccess && $passwordSuccess){

        echo "Store Data<br/>";
        try {
        // on �tablit la connection avec la base de donn�e
        $connection = Service\DBConnector::getConnection();
        } catch (PDOException $exception){
            http_response_code(500); // cela va indiquer le code retour 500 = serveur error
            echo 'A problem occured, contact support';
            exit (10); // on choisit la valeur que l'on veut sauf 0 u que l'on a une erreur ... c'est du OS (Operating System level)
        }

        // si la connection ne s'établit pas, il faut intercepter la PDO exception qui est g�n�r�e.

        // pour sql $username n'est pas un string => je l'entoure de "" que j'escape.

        $mySQLInstruction = "INSERT INTO user (username, password) VALUES (:username, :password)";

        $statement = $connection->prepare($mySQLInstruction);

        $statement->bindParam('username', $username, PDO::PARAM_STR);
        $statement->bindParam('password', $password_1, PDO::PARAM_STR);


        $myResult = $statement->execute();

        // Si il y a une erreur avec l'instruction SQL, il n'y a pas vraiment d'erreur retournée et il n'y a pas non plus de retour de l'instruction pr�c�dente.

        if (!$myResult) {
            // cette ligne permet de récupérer la dernière erreur de la connection.
            echo implode(', ', $statement->errorInfo());
            return;
        } else {

        // on a la possibilité de récupérer le dernier ID créé.
        $myId = $connection->lastInsertId();

        echo "New created ID = $myId<br />";
      }
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Register</title>

	<style>
	form{
    	width : 80%;
    	margin : auto;
    	border : 1px solid blue;
    	border-radius : 10px;
    	padding : 20px 30px;
    	box-shadow: 10px 10px 8px blue;
	}

	form div {
    	display : flex;
    	flex-direction : row;
    	justify-content : center;
    	width : 100%;
    	margin : auto;
    	padding-top : 5px;
    	padding-bottom : 5px;
    	background-color : lightblue;
	}
	form label{
	   text-align : right;
	   display : block;
       width : 40%;

	}
	form button {
	display : block;
	width : 30%;
	border-radius : 10px;
	background-color : orange;
	margin : auto;
	}

	form input {
	   border : 1px solid black;
	   border-radius : 5px;
	   padding-left : 15px;
	   margin : 0px 10px;
	   width : 40%;
	   transition-duration : 1s;
	}

	form input:hover{
	border-color : blue;
	transform : scale(1.04);
	}

	.redBox{
	   color : red;
	}
	</style>


	</head>
	<body>

<!--
    Pour éviter une ressaisie du username, on le récupère pour autant qu'il existe.
    Pour des raisons de sécurité, on ne regarnit pas les password.
 -->


	<form method="POST">
		<?php if (!($usernameSuccess ?? true)){?>
			<div class="redBox">You have an error in your username !</div>
		<?php }?>
		<div class="userData">
    		<label for "username">Your username :</label>
    		<input type="text" name="username" value="<?php echo htmlentities($_POST['username']??'')?>" placeholder="Enter your username here ! ..."/>
		</div>
		<?php if (!($passwordSuccess ?? true)){?>
			<div class="redBox">You have an error in your password !</div>
		<?php }?>
		<div class="userData">
    		<label for "password_1">Your password :</label>
    		<input type="password" name="password_1" placeholder="Enter your password here ! ..."/>
		</div>

		<div class="userData">
    		<label for "password_2">Retype your password :</label>
    		<input type="password" name="password_2" placeholder="Retype your password here ! ... "/>
		</div>
		<br/>
		<button type="submit">Send</button>
	</form>
	</body>
</html>
