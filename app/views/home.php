<?php require APPROOT . '/views/includes/header.php'; ?>
<div class="container">
    <div class="login-content">
        <form action="<?php echo URLROOT; ?>/home" method="post" class="login">
            <div class="card">
                <h1>Login Account</h1>
                <div class="form-item">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-input" name="username" value="<?php echo $data['username']; ?>" placeholder="Enter username">
                    <span class="form-error">
                        <?php echo $data['usernameError']; ?>
                    </span>
                </div>
                <div class="form-item">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-input " name="password" placeholder="Enter password">
                    <span class="form-error">
                        <?php echo $data['passwordError']; ?>
                    </span>
                </div>
                <div class="form-item">
                    <button type="submit" class="form-btn">Login</button>
                </div>
            </div>

        </form>
    </div>
</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>