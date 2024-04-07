<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/dashboard.php'; ?>

<div id="alert-container" class="alert-container">
    <?php displayFlashMessage('success'); ?>
</div>
<div class="dash-content">
    <div class="title">
        <i class="ri-dashboard-2-line"></i>
        <span class="text">Departments</span>
    </div>
    <div class="link-mb">
        <a href="<?= URLROOT; ?>/departments/create" class="add-btn">Create Department</a>
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
            <th>Departments</th>
            <th>Date created</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data['departments'] as $dept_name) : ?>
            <?php $date = formatDate($dept_name->created_at); ?>
            <!-- this params is in department controller -->
            <input type="hidden" id="urlroot" value="<?php echo URLROOT . '/departments/delete/'; ?>">
            <!-- this -->
            <tr>
                <td data-cell="Name"><?= $dept_name->department; ?></td>
                <td data-cell="Date created"><?= $date; ?></td>
                <td data-cell="Action">
                    <div class="action-item">
                        <a href="<?php echo URLROOT . '/departments/edit/' . $dept_name->id; ?>" class="action-link green">
                            <i class="ri-edit-box-line"></i>
                        </a>
                        <a href="#" class="action-link red deleteJs" onclick="openModal(<?php echo $dept_name->id; ?>)">
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