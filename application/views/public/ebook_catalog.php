<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebook Catalog (jQuery)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
            border: none;
            border-radius: .75rem;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
        }
.card-img-top {
    border-top-left-radius: .75rem;
    border-top-right-radius: .75rem;
    height: 300px;
    object-fit: contain; /* don’t change this */
    width: 100%;
    background-color: #fff; /* optional: avoids gray gaps */
}

        .footer {
            padding: 2rem 0;
            background-color: #e9ecef;
            margin-top: 3rem;
        }
.container {
    max-width: 1200px;
}
.card-img-top {
    height: 250px;
    object-fit: contain;
}
.exclusive-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 10;
}
.exclusive-cover {
    filter: brightness(0.7);
}
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Libryon</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Ebooks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url();?>index.php/auth/profile">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4"><?= isset($query) ? 'Search Results' : 'Ebook Catalog' ?></h1>
            <p class="lead"><?= isset($query) ? 'Showing results for "' . html_escape($query) . '"' : 'Browse our collection of modern ebooks (jQuery version).' ?></p>
        </div>

        <!-- Ebook cards will be injected here by jQuery -->
<div id="ebook-catalog-container" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4"></div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <span class="text-muted">© 2025 Libryon. All Rights Reserved.</span>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        const books = <?php echo json_encode($books); ?>;
        const catalogContainer = $('#ebook-catalog-container');
        const baseUrl = '<?= base_url(); ?>';

        $.each(books, function(index, book) {
            const isExclusive = book.access_type === 'EXCLUSIVE';
            const imageUrl = book.cover_image_file ? `${baseUrl}img/covers/${book.cover_image_file}` : `${baseUrl}img/xample.jpg`;
            const exclusiveBadge = isExclusive ? '<span class="badge bg-primary exclusive-badge">Exclusive</span>' : '';
            const imageClass = isExclusive ? 'card-img-top exclusive-cover' : 'card-img-top';

            const cardHtml = `
                <div class="col">
                    <div class="card h-100">
                        ${exclusiveBadge}
                        <img src="${imageUrl}" class="${imageClass}" alt="${book.title}">
                        <div class="card-body">
                            <h5 class="card-title">${book.title}</h5>
                            <p class="card-text text-muted">Language: ${book.language}</p>
                            <p class="card-text">${book.description}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="${baseUrl}index.php/ebooks/${book.book_id}" class="btn btn-primary">Read</a>
                            <div class="d-flex align-items-center mt-3">
                                <img src="https://i.pravatar.cc/30?u=${book.username}" class="rounded-circle me-2" alt="Uploader avatar">
                                <small class="text-muted">Uploaded by <a href="${baseUrl}index.php/profile/${book.username}">${book.username || 'Anonymous'}</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            catalogContainer.append(cardHtml);
        });
    });
    </script>

</body>
</html>
