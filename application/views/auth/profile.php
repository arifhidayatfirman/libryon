<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    font-family: "Poppins", sans-serif;
    background: #f7f9fc;
    color: #333;
    margin: 0;
    padding: 0;
}

.profile-container {
    max-width: 950px;
    margin: 60px auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    padding: 25px;
    transition: all 0.3s ease;
}

.profile-header {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #e5e8ed;
    padding-bottom: 20px;
    margin-bottom: 20px;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #4da3ff;
    margin-right: 20px;
    box-shadow: 0 0 10px rgba(77, 163, 255, 0.3);
}

.profile-info h1 {
    font-size: 1.8em;
    margin: 0;
    color: #222;
}

.profile-info .username {
    color: #4da3ff;
    margin-top: 5px;
    font-size: 0.9em;
}

.profile-content {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.profile-menu {
    flex: 1;
    min-width: 220px;
}

.profile-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.profile-menu ul li {
    margin: 10px 0;
}

.profile-menu a {
    color: #333;
    text-decoration: none;
    display: block;
    padding: 12px 16px;
    background: #f0f4fa;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.profile-menu a i {
    margin-right: 10px;
    color: #4da3ff;
}

.profile-menu a:hover {
    background: #4da3ff;
    color: #fff;
    transform: translateX(4px);
}

.profile-details {
    flex: 2;
    min-width: 350px;
}

.card {
    background: #fdfdfd;
    border-radius: 12px;
    border: 1px solid #e2e6ea;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.card-header {
    background: #4da3ff;
    color: #fff;
    padding: 15px 20px;
}

.card-header h2 {
    margin: 0;
    font-size: 1.2em;
}

.card-body {
    padding: 20px;
}

.card-body p {
    margin: 10px 0;
    border-bottom: 1px solid #e8ecf1;
    padding-bottom: 8px;
}

@media (max-width: 768px) {
    .profile-content {
        flex-direction: column;
    }
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    .profile-avatar {
        margin-bottom: 15px;
    }
}
</style>


<div class="profile-container">
    <div class="profile-header">
        <img src="<?php echo !empty($user['profile_picture']) ? base_url('uploads/' . $user['storage_path'] . '/' . $user['profile_picture']) : base_url('img/xample.jpg'); ?>"
             alt="User Avatar" class="profile-avatar">
        <div class="profile-info">
            <h1><?php echo $user['full_name']; ?></h1>
            <p class="username">@<?php echo $user['username']; ?></p>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-menu">
            <ul>
                <li><a href="<?php echo base_url('index.php/admin_ebooks'); ?>"><i class="fas fa-book"></i> Manage Ebooks</a></li>
                <li><a href="<?php echo base_url('auth/change_password'); ?>"><i class="fas fa-lock"></i> Change Password</a></li>
                <li><a href="<?php echo base_url('auth/ewallet_config'); ?>"><i class="fas fa-wallet"></i> Config E-Wallet</a></li>
                <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <div class="profile-details">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-user-circle"></i> User Information</h2>
                </div>
                <div class="card-body">
                    <p><strong>Full Name:</strong> <?php echo $user['full_name']; ?></p>
                    <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Storage Path:</strong> <?php echo $user['storage_path']; ?></p>
                    <p><strong>Member Since:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
