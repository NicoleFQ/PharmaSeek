<!DOCTYPE html>

<html>
	<head>
		<title> PharmaSeek  </title>
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
		
	</head>
	<body>
		
	<style>
	* {
	  box-sizing: border-box;
	}
	aside {
	  float: left;
	  margin: 0 1.5%;
	  width: 30%;}
	
	section {
	  float: right;
	  margin: 0 1.5%;
	  width: 65%;
	}
	
	th, td {
  padding: 10px;
  text-align: left;
}
	</style>

	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="MainPage.html">PharmaSeek</a>
    <a style = "text-align:right" class="navbar-brand" href="Admin_Log_In.php">Admin Login</a>
  </nav>
		
		<form name= "search" action = "medDetails.php" method = "POST">
			<h1 style = "text-align:center;"> Medicine Target Illness</h1>
		</form>
		<div class="col-lg-1" style = "margin:auto;"></div>
		<div class="col-lg-11" style = "margin:auto;">
		<?php
		// Create connection
			$servername = "localhost";
			$username = "root";
			$password = "mysql";
			$database = "pharmaSeek";
			$conn = new mysqli($servername, $username, $password, $database);
			// Check connection
			if ($conn->connect_error) 
			{
			    die("Connection failed: " . $conn->connect_error);
			} 

			$id = $_GET['id'];
	
			$sql = "SELECT medicine.name as medicine, illness.name as illness, illness.major_symptoms FROM illness JOIN medicine_illness 
								ON medicine_illness.illness_id = illness.illness_id 
								JOIN medicine ON medicine_illness.medicine_id = medicine.medicine_id
								WHERE medicine.medicine_id ='$id';";
			
			//$result = $conn->query($sql);
			$result = $conn->query($sql);
			echo "<p style = 'color: gray; font-size:20px;'> Medicine ID ".$id."</p>";
			if ($result)
			{
				echo "<table style='width:100%;'>
							<tr><th>Name</th>
							<th>Illness</th>
							<th>Major Symptoms</th></tr>";
							
				while($row = $result -> fetch_assoc())
				{
					echo "<tr><td>".$row["medicine"]. "</td>
									<td>".$row["illness"]. "</td>
									<td>".$row["major_symptoms"]. "</td>
									</tr>";
				}
				
				$result->free();
				mysqli_close($conn);
			}
			else
					{
						echo("Error description: " . mysqli_error($conn));
					}	
		?>

</body>
</html>