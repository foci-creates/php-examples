<?php 

if(isset($_POST['submit'])) {
	//Add database connection
	require 'database.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmPass = $_POST['confirmPassword'];

	if(empty($username) || empty($password) || empty($confirmPass)) {
		header("Location: ../register.php?error=empty_fields&username=" . $username);
		exit();
	} else if(!preg_match("/^[a-zA-z0-9]*/", $username)) {
		header("Location: ../register.php?error=invalid_username&username=" . $username);
		exit();
	} else if($password !== $confirmPass) {
		header("Location: ../register.php?error=passwords_do_not_match&username=" . $username);
		exit();
	} else {
		$sql = "SELECT username FROM users WHERE username = ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../register.php?error=sql_error");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$rowCount = mysqli_stmt_num_rows($stmt);

			if($rowCount > 0) {
				header("Location: ../register.php?error=username_taken");
				exit();
			} else {
				$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../register.php?error=sql_error");
					exit();
				} else {
					$hashedPass = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPass);
					mysqli_stmt_execute($stmt);
						header("Location: ../register.php?success=registered");
						exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
?>