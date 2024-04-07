<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/dashboard.php'; ?>


<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="ri-dashboard-2-line"></i>
            <span class="text">Dashboard</span>
        </div>

        <div class="boxes">
            <div class="box box1">
                <i class="uil uil-thumbs-up"></i>
                <span class="text">Total Records</span>
                <span class="number">1</span>
            </div>
            <div class="box box2">
                <i class="uil uil-comments"></i>
                <span class="text">Total Users</span>
                <span class="number"><?= $data['totalUsers']; ?></span>
            </div>
            <div class="box box3">
                <i class="uil uil-share"></i>
                <span class="text">Departments</span>
                <span class="number"><?= $data['totalDepartment']; ?></span>
            </div>
        </div>
    </div>

    <div class="activity">
        <div class="title">
            <i class="ri-history-line"></i>
            <span class="text">Recent Activity</span>
        </div>

        <div class="activity-data">
            <div class="data names">
                <span class="data-title">Name</span>
                <span class="data-list">Michael Oracion</span>

            </div>
            <div class="data email">
                <span class="data-title">Department</span>
                <span class="data-list">IT department</span>

            </div>
            <div class="data joined">
                <span class="data-title">Date</span>
                <span class="data-list">April 04, 2024</span>

            </div>


        </div>
    </div>
</div>
<?php require APPROOT . '/views/includes/dash-footer.php'; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>