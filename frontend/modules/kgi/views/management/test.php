<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.star {
			width: 0;
			height: 0;
			border-left: 50px solid transparent;
			border-right: 50px solid transparent;
			border-bottom: 100px solid #f00;
			/* Adjust color as needed */
			position: relative;
		}

		.star:before {
			content: "";
			width: 0;
			height: 0;
			border-left: 50px solid transparent;
			border-right: 50px solid transparent;
			border-top: 100px solid #f00;
			/* Adjust color as needed */
			position: absolute;
			top: 25px;
			left: -50px;
		}
	</style>
</head>

<body>
	<?php
	// PHP code to draw a star
	echo '<div class="star mt-90"></div>';
	?>
</body>

</html>