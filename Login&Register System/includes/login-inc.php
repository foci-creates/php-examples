<?php 

if(isset($_POST['submit'])) {
	require 'database.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		header("Location: ../index.php?error=empty_fields");
        exit();
	} else {
		$sql = "SELECT * FROM users WHERE username = ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sql_error");
        	exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if($row = mysqli_fetch_assoc($result)) {
				$passCeck = password_verify($password, $row['password']);
				if($passCeck == false) {
					header("Location: ../index.php?error=wrong_password");
        			exit();
				} else if($passCeck == true) {
					session_start();
					$_SESSION['sessionId'] = $row['id'];
					$_SESSION['sessionUser'] = $row['username'];
					header("Location: ../index.php?success=logged_in");
        			exit();
				} else {
					header("Location: ../index.php?error=wrong_password");
        			exit();
				}
			} else {
				header("Location: ../index.php?error=no_user");
        		exit();
			}
		}
	}

} else {
	header("Location: ../index.php?error=access_forbidden");
    exit();

}
?>