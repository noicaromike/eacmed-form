<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/staff.dashboard.php'; ?>

<div class="dash-content">

    <div class="users-create">
    <div class="card">
            <div class="card-title">
                Your account
            </div>
            <div class="sub-title">
                quick and easy.
            </div>
            <!-- <?php var_dump($data['role']); ?> -->
            <form action="<?php echo URLROOT . '/staff/profile/' . $data['id']; ?>" method="POST">
                <div class="form-item">
                    <input type="text" class="form-input" placeholder="First name" name="firstname" value="<?= $data['firstname']; ?>">
                    <span class="form-error">
                        <?= $data['firstnameError']; ?>
                    </span>
                </div>
                <div class="form-item">
                    <input type="text" class="form-input" placeholder="Last name" name="lastname" value="<?= $data['lastname']; ?>">
                    <span class="form-error">
                        <?= $data['lastnameError']; ?>

                    </span>
                </div>
                
                <div class="form-item">
                    <input type="text" class="form-input" placeholder="Username" name="username" value="<?php echo $data['username']; ?>">
                    <span class="form-error">
                        <?= $data['usernameError']; ?>

                    </span>
                </div>
                <div class="form-item">
                    <input type="password" class="form-input" placeholder="Password" name="password">
                    <span class="form-error">
                        <?= $data['passwordError']; ?>
                    </span>
                </div>
                <div class="form-item">
                    <button class="form-btn" type="submit">Update</button>
                </div>

            </form>

        </div>






    </div>
</div>




<?php require APPROOT . '/views/includes/dash-footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>