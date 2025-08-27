<script>
	document.addEventListener("DOMContentLoaded", function() {
		// ดักจับเหตุการณ์การกดปุ่ม Enter
		document.querySelectorAll('.assign-target').forEach(function(input, index) {
			input.addEventListener('keydown', function(event) {
				// เช็คถ้ากดปุ่ม Enter
				if (event.key == 'Enter') {
					event.preventDefault(); // ป้องกันการส่งฟอร์ม

					// หาค่าของ teamId จาก input field
					const teamId = input.name.match(/\d+/)[0];

					// หาค่า checkbox ที่เกี่ยวข้อง
					const checkbox = document.getElementById('team-' + teamId);

					// ตรวจสอบสถานะของ checkbox
					if (checkbox && !checkbox.checked) {
						checkbox.checked = true; // หาก checkbox ยังไม่ถูกเลือกให้เลือก
						// เรียกใช้ฟังก์ชัน assignKgiToEmployeeInTeam หลังจากเลือก checkbox
						if (checkbox && checkbox.checked) {
							assignKgiToEmployeeInTeam(teamId, <?= $kgiId ?>); // เรียกฟังก์ชัน
						}
					}

					// หาตำแหน่งของ textbox ถัดไป
					const nextInput = document.querySelectorAll('.assign-target')[index + 1];
					if (nextInput) {
						nextInput.focus(); // ส่งเคอร์เซอร์ไปที่ textbox ถัดไป
					}
				}
			});
		});
	});
</script>



<!-- employee_team.php -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		// ดักจับเหตุการณ์การกดปุ่ม Enter
		document.querySelectorAll('.assign-target').forEach(function(input, index) {
			input.addEventListener('keydown', function(event) {

				if (event.key == 'Enter') {

					event.preventDefault(); // ป้องกันการส่งฟอร์ม

					const employeeId = input.name.match(/\d+/)[0];

					const checkbox = document.getElementById('employee-' + employeeId);

					if (checkbox && !checkbox.checked) {
						checkbox.checked = true; // หาก checkbox ยังไม่ถูกเลือกให้เลือก
					}

					// // หาตำแหน่งของ textbox ถัดไป
					const nextInput = document.querySelectorAll('.assign-target')[index + 1];
					if (nextInput) {
						nextInput.focus(); // ส่งเคอร์เซอร์ไปที่ textbox ถัดไป
					}
				}
			});
		});
	});
</script>
<!-- employee_team_target.php -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		// ดักจับเหตุการณ์การกดปุ่ม Enter
		document.querySelectorAll('.assign-target').forEach(function(input, index) {
			input.addEventListener('keydown', function(event) {

				if (event.key == 'Enter') {

					event.preventDefault(); // ป้องกันการส่งฟอร์ม

					const employeeId = input.name.match(/\d+/)[0];

					const checkbox = document.getElementById('employee-' + employeeId);

					if (checkbox && !checkbox.checked) {
						checkbox.checked = true; // หาก checkbox ยังไม่ถูกเลือกให้เลือก
					}

					// // หาตำแหน่งของ textbox ถัดไป
					const nextInput = document.querySelectorAll('.assign-target')[index + 1];
					if (nextInput) {
						nextInput.focus(); // ส่งเคอร์เซอร์ไปที่ textbox ถัดไป
					}
				}
			});
		});
	});
</script>