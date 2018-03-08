<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? null;
    $password_1 = $_POST['password_1'] ?? null;
    $password_2 = $_POST['password_2'] ?? null;

    echo 'Validate data<br>';
    
    
    $usernameSuccess = (is_string($username) && strlen($username) > 2);
    $passwordSuccess = ($password_1 == $password_2 && strlen($password_1) > 7);
    
    
    if ($usernameSuccess && $passwordSuccess){
        echo "Store Data<br/>";
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
    Pour �viter une ressaisie du username, on le r�cup�re pour autant qu'il existe.
    Pour des raisons de s�curit�, on ne regarnit pas les password.
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