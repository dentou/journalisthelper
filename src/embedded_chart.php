<?php 
 	$dataType = $_GET['dataType'];
 	$displayType = $_GET['displayType'];
 	$timeline = $_GET['timelime'];

 	switch ($dataType) {
 		case 'cb':
 			$dtName = "Carbons";
            $dtVar = "carbons";
 			break;
 		case 'gt':
 			$dtName = "Global Tenperature";
            $dtvar = "globaltemperature";
 			break;
		case 'si':
			$dtName = "Sea Ice";
            $dtvar = "seaice";
			break;
		case 'sl':
			$dtName = "Sea Level";
            $dtvar = "sealevel";
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
    <script id="embedded_chart" dataType="<?php echo htmlspecialchars($dtVar)?>" src="embedded_chart.js">

    </script>

    <p>...After the script.</p>

</body>
</html>