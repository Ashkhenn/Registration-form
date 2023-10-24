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
		<form id="RegistrationForm">
			<div class="LogIn1">
				<h1><a href="index.php">Registration</a></h1>
				<input id="FirstName" type="text" placeholder="Անուն (լատինատառ)" required>
				<input id="LastName" type="text" placeholder="Ազգանուն (լատինատառ)" required>
				<input id="Email" type="email" placeholder="Էլ․ հասցեն" required>
				<input id="Password1" type="password" placeholder="Գաղտնաբառ (Ամենաքիչը 8 նիշ)" required>
				<input id="Password2" type="password" placeholder="Կրկնել Գաղտնաբառը" required>
				<div>
					<p id="Error" style="color:red"></p>
				</div>
				<input class="SignIn" type="submit"  value="Գրանցվել">
				<p><a href="LogIn.php">Արդեն ունե՞ք հաշիվ</a></p>
			</div>
		</form>	
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/js.js"></script>
</html>