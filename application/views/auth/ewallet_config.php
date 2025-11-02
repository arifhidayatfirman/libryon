<div class="card">
    <div class="card-header">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php echo validation_errors(); ?>

        <?php echo form_open('auth/ewallet_config'); ?>
            <div class="form-group">
                <label for="donation_option_id">E-Wallet Provider</label>
                <select name="donation_option_id" id="donation_option_id" class="form-control">
                    <option value="">Select an option</option>
                    <?php foreach ($options as $option): ?>
                        <option value="<?php echo $option['option_id']; ?>"
                            <?php echo (isset($user['donation_option_id']) && $user['donation_option_id'] == $option['option_id']) ? 'selected' : ''; ?>>
                            <?php echo $option['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="donation_target">E-Wallet Number</label>
                <input type="text" name="donation_target" id="donation_target" class="form-control"
                       value="<?php echo isset($user['donation_target']) ? $user['donation_target'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update E-Wallet</button>
        <?php echo form_close(); ?>
    </div>
</div>