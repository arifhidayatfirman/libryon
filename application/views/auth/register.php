<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }
        .register-form {
            width: 100%;
            max-width: 450px;
            padding: 15px;
        }
    </style>
</head>
<body>

<div class="register-form text-center">
    <h1 class="h3 mb-3 fw-normal">Create an Account</h1>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php echo form_open('auth/process_registration'); ?>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" required>
            <label for="full_name">Full Name</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" required>
            <label for="username">Username</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo set_value('email'); ?>" required>
            <label for="email">Email address</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password" required>
            <label for="password_confirm">Confirm Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

    </form>

    <p class="mt-3">
        Already have an account? <a href="<?php echo site_url('login'); ?>">Sign in</a>
    </p>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
