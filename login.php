<?php
include "connexion.php";
session_start();

if (isset($_POST['submit-btn'])){
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
    
    $filter_email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email=mysqli_real_escape_string($conn, $filter_email);


    $filter_password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password=mysqli_real_escape_string($conn, $filter_password);
    $select_user=mysqli_query($conn,"SELECT * FROM user Where email='$email' && password='$password'") or die("query failed");

	if(mysqli_num_rows($select_user)>0){
				
		echo'saluuuuuuuuuuuuuuuut';

		$row=mysqli_fetch_assoc($select_user);
		if ($row['user_type']=='admin'){

			$_SESSION['admin_name']=$row['nom'];
			$_SESSION['admin_email']=$row['email'];
			$_SESSION['admin_id']=$row['id'];
			header('location:index.php');
		}
		else if($row['user_type']=='user'){
			
			$_SESSION['user_name']=$row['nom'];
			$_SESSION['user_email']=$row['email'];
			$_SESSION['user_id']=$row['id'];
			header('location:index.php');
		}
		else{
			echo'nooooooooooo';
			$message[]='incorrect email ou mot de passe';
		}

			

		
		
	

	}
}

	 

    
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="" method="post">
				<div>email</div>
				<input type="text" name="email" placeholder="email" id="username" required>
				<div>password</div>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit"  name="submit-btn" value="Se Connecter">
                <p> vous n'avez pas un compte ? <a href='registre.php'>inscrivez vous</a> </p>
			</form>
		</div>
	</body>
</html>