<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Student User</title>
</head>
<body>


	<form method="POST" action="layered/public/register">

		<label for="username">Username</label>
		<input type="" name="username">

		<label for="password">Password</label>
		<input type="" name="password">

		<button type="submit">Submit</button>

	</form>

	<?php if (isset($errorMessage)): ?>

		<?php echo "$errorMessage"; ?>

	<?php endif ?>

</body>
</html>