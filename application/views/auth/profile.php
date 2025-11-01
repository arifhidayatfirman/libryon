<div class="card">
    <div class="card-header">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="card-body">
        <p><strong>Full Name:</strong> <?php echo $user['full_name']; ?></p>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Storage Path:</strong> <?php echo $user['storage_path']; ?></p>
        <p><strong>Member Since:</strong> <?php echo $user['created_at']; ?></p>
    </div>
</div>