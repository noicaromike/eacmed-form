<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/dashboard.php'; ?>

<div id="alert-container" class="alert-container">
    <?php displayFlashMessage('success'); ?>
</div>

<div class="dash-content">
    <div class="title">
        <i class="ri-dashboard-2-line"></i>
        <span class="text">Users</span>
    </div>
    <div class="link-mb">
        <a href="<?= URLROOT; ?>/users/create" class="add-btn">Create Account</a>
    </div>
    <div class="pagination">
        <?php if ($data['currentPage'] >= 1) : ?>
            <a href="?page=<?php echo $data['currentPage'] - 1; ?>" class="add-btn">Previous</a>
        <?php endif; ?>
        <p>Page <?php echo $data['currentPage']; ?> of <?php echo $data['totalpages']; ?></p>
        <?php if ($data['currentPage'] < $data['totalpages']) : ?>
            <a href="?page=<?php echo $data['currentPage'] + 1; ?>" class="add-btn">Next</a>
        <?php endif; ?>
        <?php if ($data['currentPage'] == $data['totalpages']) : ?>
            <a href="?page=<?php echo $data['currentPage']; ?>" class="add-btn">Next</a>
        <?php endif; ?>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Role</th>
            <th>Date created</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data['users'] as $user) : ?>
            <?php $date = formatDate($user->created_at); ?>
            <!-- this params is in users controller -->
            <input type="hidden" id="urlroot" value="<?php echo URLROOT . '/users/delete/'; ?>">
            <tr>
                <td data-cell="Name"><?= $user->firstname . ' ' . $user->lastname; ?></td>
                <td data-cell="Department"><?= $user->dept_name; ?></td>
                <td data-cell="Role"><?= $user->role_name; ?></td>
                <td data-cell="Date created"><?= $date; ?></td>
                <td data-cell="Action">
                    <div class="action-item">
                        <a href="<?php echo URLROOT . '/users/edit/' . $user->id; ?>" class="action-link green">
                            <i class="ri-edit-box-line"></i>
                        </a>
                        <a href="#" class="action-link red deleteJs" onclick="openModal(<?php echo $user->id; ?>)">
                            <i class="ri-delete-bin-6-line"></i>
                        </a>
                    </div>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <!-- modal delete its in include folder -->
    <?php require APPROOT . '/views/includes/modal.delete.php'; ?>


</div>



<?php require APPROOT . '/views/includes/dash-footer.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>