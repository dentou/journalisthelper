<?php 
 	$dataType = $_GET['dataType'];
 	$displayType = $_GET['displayType'];
 	$timeline = $_GET['timelime'];

 	switch ($dataType) {
 		case 'cb':
 			$dtName = "Carbon";
 			break;
 		case 'gt':
 			$dtName = "Global Tenperature";
 			break;
		case 'si':
			$dtName = "Sea Ice";
			break;
		case 'sl':
			$dtName = "Sea Level";
			break;	
 		default:
 			die('invalid link');
 			break;
 	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($dtName);?></title>
</head>
<body>

    <p><?php echo htmlspecialchars($dtName);?> data</p>

    <script src="../node_modules/chart.js/dist/Chart.js"></script>
    <canvas id="myChart" width="300" height="300"></canvas>
    <script src="embedded_chart.js">

    </script>

    <p>...After the script.</p>

</body>
</html>