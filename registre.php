
<?php
echo'<p>salluuuuuuut </p>';
include "connexion.php";
echo'<p>salluuuuuuut </p>';
if (isset($_POST["submit-btn"])){
	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {
	echo'<p>salluuuuuuut </p>';
	echo'<p>salluuuuuuut </p>';
    $filter_name=filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name=mysqli_real_escape_string($conn, $filter_name);

	$filter_lastname=filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $lastname=mysqli_real_escape_string($conn, $filter_lastname);


    $filter_email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email=mysqli_real_escape_string($conn, $filter_email);


    $filter_password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password=mysqli_real_escape_string($conn, $filter_password);

    $filter_cpassword=filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
    $cpassword=mysqli_real_escape_string($conn, $filter_cpassword);
	//    $name=$_POST['name'];
    //    $email=$_POST['email'];
	//    $password=$_POST['password'];
	//    $cpassword=$_POST['cpaswword'];



    // filtrer list par l email envoyer par user pour voir si il est enregistrer ou pas
    
    $select_user=mysqli_query($conn, "SELECT * FROM `user` Where `email`='$email'") or die('query failed');
	echo'hooooooooooo';
 
	if(mysqli_num_rows($select_user)>0){
		$message[]='user already exist';
		echo'aaaaaaaaaaa';
	}
	else{
		if($password!=$cpassword){
			$message[]='wrong password';
			echo 'hiiiiiiiiiiiiiiiiiiiiii';
		}
		//si email pas trouve enregistrer le user insertion de ses donnes dans la table user
		else{
			echo'<p>salllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllluuuuuuuuuuuuuuuuuuuuuuuuuutt</p>';
			mysqli_query($conn, "INSERT INTO `user` (`nom`, `prenom` , `password` , `email` ) VALUES ('$name','$lastname','$password','$email')") or die ('query failed');
			$message[]='registred successfully';
			header('location:login.php');

		}
	}
}   
else {
	// Si toutes les variables ne sont pas envoyées, afficher un message d'erreur
	$message[] = 'Please fill all fields';
}
} 

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>S'inscrire</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<?php
			if(isset($message)){
				foreach($message as $message){
				echo'
				    <div class="message">
					    <span> '.$message.' </span>
						<i class="fas fa-times" onclick="this.parentElement.remove()"></i>
					</div>
					';
				}
			}
			?>
			<h1>S'inscrire</h1>
			<form  method="post">
				<label for="name">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="name" placeholder="Username" id="username" >
				<label for="Lastname">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="lastname" placeholder="Lastname" id="Lastname" >
                <label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="text" name="email" placeholder="email" id="email" >
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" >
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="cpassword" placeholder="Confirm Password" id="password" >
				<input type="submit" name="submit-btn" value="S'inscrie">
                <p> vous avez un compte ? <a href='login.php'>Connecter vous</a> </p>
			</form>
		</div>
	</body>
</html>