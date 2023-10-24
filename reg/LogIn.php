<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>yoUnique</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Great+Vibes&family=Lobster&family=Pacifico&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="LogInBack">
		<form id="LogIn">
			<div class="LogIn">
				<h1><a href="index.php">Login</a></h1>
				<input id="EmailForLogIn" type="email" placeholder="Մուտքագրեք Էլ․ հասցեն">
				<input id="PasswordForLogIn" type="password" placeholder="Մուտքագրեք գաղտնաբառը">
				<p id="Error" style="color:red"></p>
				<div class="frgpass">
					<p><a href="ForgotPass.php">Մոռացե՞լ եք գաղտնաբառը</a></p>
				</div>
				<input id="SignIn" class="SignIn" type="submit"  value="Մուտք Գործել">
				<p><a href="Registration.php">Գրանցվել հիմա</a></p>
			</div>
		</form>	
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/js.js"></script>
</html>