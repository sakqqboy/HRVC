<?php
if ($_FILES) {
	$uploadDir = 'uploads/';
	$uploadedFile = $uploadDir . basename($_FILES['file']['name']);

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)) {
		echo "File is valid, and was successfully uploaded.";
	} else {
		echo "Upload failed.";
	}
}
