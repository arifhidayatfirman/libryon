<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Ebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add New Ebook</h1>
        <a href="<?php echo site_url('admin_ebooks'); ?>" class="btn btn-secondary">Back to List</a>
    </div>

    <!-- Display Messages -->
    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open_multipart('admin_ebooks/add'); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo set_value('title'); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" name="author" value="<?php echo set_value('author'); ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo set_value('description'); ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="access_type" class="form-label">Access Type</label>
                        <select class="form-select" name="access_type">
                            <option value="PUBLIC" <?php echo set_select('access_type', 'PUBLIC', TRUE); ?>>Public</option>
                            <option value="PRIVATE" <?php echo set_select('access_type', 'PRIVATE'); ?>>Private</option>
                            <option value="EXCLUSIVE" <?php echo set_select('access_type', 'EXCLUSIVE'); ?>>Exclusive</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="donation_info" class="form-label">Donation Info (if Exclusive)</label>
                        <input type="text" class="form-control" name="donation_info" value="<?php echo set_value('donation_info'); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cover_image_file" class="form-label">Cover Image (JPG, PNG)</label>
                        <input class="form-control" type="file" name="cover_image_file" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="file_name" class="form-label">Ebook File (PDF)</label>
                        <input class="form-control" type="file" name="file_name" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Ebook</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
