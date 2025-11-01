<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">Libryon</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(); ?>">Ebooks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('admin_ebooks'); ?>">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo base_url('img/covers/' . $book['cover_image_file']); ?>" class="img-fluid" alt="<?php echo $book['title']; ?>">
            </div>
            <div class="col-md-8">
                <h1><?php echo $book['title']; ?></h1>
                <p class="text-muted">By <?php echo $book['author']; ?></p>
                <p><?php echo $book['description']; ?></p>
                <p><strong>Language:</strong> <?php echo $book['language']; ?></p>
                <p><strong>Access:</strong> <?php echo $book['access_type']; ?></p>
                <?php if ($book['access_type'] == 'EXCLUSIVE'): ?>
                    <p><strong>Donation Info:</strong> <?php echo $book['donation_info']; ?></p>
                <?php endif; ?>
                <a href="#" class="btn btn-primary">Read Now</a>
            </div>
        </div>
    </div>

    <footer class="footer text-center mt-5">
        <div class="container">
            <span class="text-muted">© 2025 Libryon. All Rights Reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>