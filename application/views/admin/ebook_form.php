    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?php echo isset($book) ? 'Edit Ebook' : 'Add New Ebook'; ?></h1>
        <a href="<?php echo base_url('index.php/admin_ebooks'); ?>" class="btn btn-secondary">Back to List</a>
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
            <?php
            $action = isset($book) ? 'admin_ebooks/update/' . $book['book_id'] : 'admin_ebooks/add';
            echo form_open_multipart($action);
            ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo set_value('title', isset($book) ? $book['title'] : ''); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" name="author" value="<?php echo set_value('author', isset($book) ? $book['author'] : ''); ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo set_value('description', isset($book) ? $book['description'] : ''); ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="access_type" class="form-label">Access Type</label>
                        <select class="form-select" name="access_type">
                            <option value="PUBLIC" <?php echo set_select('access_type', 'PUBLIC', isset($book) && $book['access_type'] == 'PUBLIC'); ?>>Public</option>
                            <option value="PRIVATE" <?php echo set_select('access_type', 'PRIVATE', isset($book) && $book['access_type'] == 'PRIVATE'); ?>>Private</option>
                            <option value="EXCLUSIVE" <?php echo set_select('access_type', 'EXCLUSIVE', isset($book) && $book['access_type'] == 'EXCLUSIVE'); ?>>Exclusive</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="language" class="form-label">Language</label>
                        <select class="form-select" name="language">
                            <option value="ID" <?php echo set_select('language', 'ID', isset($book) && $book['language'] == 'ID'); ?>>ID</option>
                            <option value="EN" <?php echo set_select('language', 'EN', isset($book) && $book['language'] == 'EN'); ?>>EN</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="donation_info" class="form-label">Donation Info (if Exclusive)</label>
                        <input type="text" class="form-control" name="donation_info" value="<?php echo set_value('donation_info', isset($book) ? $book['donation_info'] : ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cover_image_file" class="form-label">Cover Image (JPG, PNG)</label>
                        <input class="form-control" type="file" name="cover_image_file" <?php echo isset($book) ? '' : 'required'; ?>>
                        <?php if (isset($book) && $book['cover_image_file']): ?>
                            <small class="form-text text-muted">Current file: <?php echo $book['cover_image_file']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="file_name" class="form-label">Ebook File (PDF)</label>
                        <input class="form-control" type="file" name="file_name" <?php echo isset($book) ? '' : 'required'; ?>>
                        <?php if (isset($book) && $book['file_name']): ?>
                            <small class="form-text text-muted">Current file: <?php echo $book['file_name']; ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($book) ? 'Update Ebook' : 'Add Ebook'; ?></button>
            </form>
        </div>
    </div>