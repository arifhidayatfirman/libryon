<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebook List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ebook List</h1>
        <a href="<?php echo site_url('admin_ebooks/create'); ?>" class="btn btn-primary">Add New Ebook</a>
    </div>

    <!-- Display Messages -->
    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Access Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($books)): ?>
                            <?php foreach ($books as $book): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo base_url('img/covers/' . $book['cover_image_file']); ?>" alt="Cover" width="50">
                                </td>
                                <td><?php echo html_escape($book['title']); ?></td>
                                <td><?php echo html_escape($book['author']); ?></td>
                                <td><?php echo html_escape($book['access_type']); ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning disabled">Edit</a>
                                    <a href="<?php echo site_url('admin_ebooks/delete/' . $book['book_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ebook?');">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No ebooks found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
