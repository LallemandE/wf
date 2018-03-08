<?php 
$currentTimeSlot = (new DateTime())->format('H');
$range = range(0,10);

if ($currentTimeSlot <12 ){
    $toDisplay = 'Good Morning';
} else if ($currentTimeSlot <18) {
    $toDisplay = 'Good Afternoon';
} else if ($currentTimeSlot <22) {
    $toDisplay = 'Good evening';
} else {
    $toDisplay = "Please, go to bed !";
}

// La ligne suivante est la nouvelle fonctionnalité de PHP 7 COALESCING

$firstname = $_GET['firstname'] ?? 'John';


/* Les lignes suivantes sont équivalentes  mais plus longues à écrire !
  
if (isset($_GET['firstname'])){
    $firstname = $_GET['firstname'];
} else {
    $firstname = "John";
}
*/

$firstname =htmlentities($firstname);
// on aurait pu aussi directement appliquer htmlentities au PHP 7 Coalescing


$lastname = $_GET['lastname'] ?? "DOE";
/*
if (isset($_GET['lastname'])){
    $lastname = $_GET['lastname'];
} else {
    $lastname = "DOE";
}
*/

$lastname = htmlentities($lastname);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <title>my title here</title>
</head>

<body>
	The current time is : <?php echo (new DateTime())->format("Y-m-d h:i:s"); ?> <br />
	Hello  <?php echo $firstname . ' ' . $lastname. '! '; echo"<h1>$toDisplay</h1>"; ?> <br/>
	Et maintenant, la machine sait compter .... <br>
	<?php for($i = 0; $i<=10; $i++) echo "$i ";?><br>

<!-- 
dans la première version, je sors un maximum d'élément HTML de mon code. 
Ca marche vu que tout ce qui est entre une fermeture de php et l'ouverture suivante doit être
considéré comme si il s'agissait d'un echo
 -->
	
	<ul>
	<?php foreach ($range as $element){ ?>
	<li>
	    <?php echo $element; ?>
	</li>
	<?php } ?>    
	</ul>
	
	
ou encore

<!-- 
dans la deuxième version, je génère explicitement toutes les balises LI dans mon code PHP sans en sortir.
 -->
 	
		<ul>
			<?php
			foreach ($range as $element){ 	
	            echo '<li>' . $element . '</li>';
			}
			?>
		</ul>
	
	
</body>

</html>