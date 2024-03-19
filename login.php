<?php  
session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            
            $query = "select * from users where user_name = '$user_name' limit 1";

            $result = mysqli_query($con, $query);

            if($result)
            {
            	if($result && mysqli_num_rows($result) > 0)
        		{
            		$user_data = mysqli_fetch_assoc($result);

            		if($user_data['password'] === $password)
            		{
            			$_SESSION['user_id'] = $user_data ['user_id'];
            			header("Location: index.php");
            			die;
            		}
       			}
            }
    		 echo "Wrong username or password!";
        }else
        {
            echo "Please enter some vaild information!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<style type="text/css">
		body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
	</style>

	<div id="form">
		<form method="post">
			<div style="font-size: 20px; margin: 10px">Login</div>
            <label for="user_name">Username:</label>
			<input type="text" name="user_name"><br><br>
            <label for="password">Password:</label>
			<input type="password" name="password"><br><br>
			<button type="submit">Submit</button><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>