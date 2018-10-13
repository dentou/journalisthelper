<!DOCTYPE html>
<html>
<head>
	<title>Real Time Data</title>
</head>
<body>
	<h1>Realtime Data</h1>

	<h2>date: <p id='dateField'></p></h2>
	<h2>data: <p id='dataField'></p></h2>

	<script type="text/javascript">
	$(document).ready(function() {
		setInterval(function(){

		    $.ajax({

			    type: "POST",
			    url: "http://localhost/journalisthelper/test/realtimeData.php?url=carbon",
			    processData: false,
			    contentType: "application/json",
			    data: '',
			    success: function(r) {
			            console.log(r)
			            var date = document.getElementById("dateField");
						date.innerHTML = "New Heading";
						var data = document.getElementById("dataField");
						data.innerHTML = "New Heading";
			    },
			    error: function(r) {
			    		console.log(r)
			            $("p.error").value(JSON.parse(r).error);
			    }

			});

		}, 1000);	
	});
	</script>

</body>
</html>