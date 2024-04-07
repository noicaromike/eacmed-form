<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/dashboard.php'; ?>

<div class="dash-content">

    <div class="users-create">
        <div class="card">
            <div class="card-title">
                Add Department
            </div>
            <div class="sub-title">
                quick and easy.
            </div>
            <form action="<?php echo URLROOT; ?>/departments/create" method="POST">
                <div class="form-item">
                    <input type="text" class="form-input" placeholder="Enter Department" name="department" value="">
                    <span class="form-error">
                        <?= $data['departmentError']; ?>
                    </span>
                </div>
                <div class="form-item">
                    <button class="form-btn" type="submit">Register</button>
                </div>

            </form>

        </div>
    </div>

</div>

<?php require APPROOT . '/views/includes/dash-footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>