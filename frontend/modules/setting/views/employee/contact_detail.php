<div class="d-flex row" style="gap: 40px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600">Contact & Personal Details</span>
        <hr class="hr-group">
    </div>

    <div class="start-center" style="gap: 30px; display: flex; flex-wrap: wrap;">
        <!-- Name -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Name</span>
            </div>
            <div style="flex: 8;">
                <span
                    class="font-size-16 font-weight-500"><?= $employee['employeeFirstname'] . ' ' . $employee['employeeSurename']  ?? '-' ?></span>
            </div>
        </div>

        <!-- Employee ID -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Employee ID</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['employeeNumber'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Nationality -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Nationality</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['countryName'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Gender -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Gender</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?php 
                    if($employee['gender'] == 1){
                        echo 'Male';
                    }else if($employee['gender'] == 2){
                        echo 'Female';
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Date of Birth -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Date of Birth</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= isset($employee['birthDate']) ? date('d/m/Y', strtotime($employee['birthDate'])) : '-' ?>
                </span>
            </div>
        </div>

        <!-- Age -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Age</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= isset($employee['birthDate']) ? (new DateTime())->diff(new DateTime($employee['birthDate']))->y . ' years' : '-' ?>
                </span>
            </div>
        </div>

        <!-- Marital Status -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Marital Status</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['maritalStatus'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Contact Number -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Contact Number</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['phone'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Emergency Contact</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['emergencyContact'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Work Email -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Work Email</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['workEmail'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Personal Email -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Personal Email</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['personalEmail'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Address -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Address</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['address'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Language (Primary) -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Language (Primary)</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['languagePrimary'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Language (Additional) -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Language (Additional)</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['languageAdditional'] ?? '-' ?></span>
            </div>
        </div>

        <!-- LinkedIn -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">LinkedIn</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['linkedin'] ?? '-' ?></span>
            </div>
        </div>
    </div>
</div>