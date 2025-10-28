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
            object-fit: contain;
            width: 100%;
        }
        .footer {
            padding: 2rem 0;
            background-color: #e9ecef;
            margin-top: 3rem;
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4">Ebook Catalog</h1>
            <p class="lead">Browse our collection of modern ebooks (jQuery version).</p>
        </div>

        <!-- Ebook cards will be injected here by jQuery -->
        <div id="ebook-catalog-container" class="row row-cols-2 g-4"></div>
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
        const ebooks = [
            {
                title: 'The Adventures of CodeIgniter',
                description: 'A thrilling story of a framework rising to the challenge.',
                image: '<?=base_url();?>img/xample.jpg'
            },
            {
                title: 'Bootstrap 5: The Missing Manual',
                description: 'Everything you need to know to build beautiful, responsive websites.',
                image: '<?=base_url();?>img/xample.jpg'
            },
            {
                title: 'PHP: The Right Way',
                description: 'An easy-to-read, quick reference for PHP best practices.',
                image: '<?=base_url();?>img/xample.jpg'
            },
            {
                title: 'The Art of Web Design',
                description: 'Explore the principles of design and create stunning web experiences.',
                image: '<?=base_url();?>img/xample.jpg'
            },
            {
                title: 'Modern JavaScript Explained',
                description: 'A deep dive into the features and patterns of modern JavaScript.',
                image: '<?=base_url();?>img/xample.jpg'
            },
            {
                title: 'Database Design for Beginners',
                description: 'Learn the fundamentals of designing efficient and scalable databases.',
                image: '<?=base_url();?>img/xample.jpg'
            }
        ];

        const catalogContainer = $('#ebook-catalog-container');

        $.each(ebooks, function(index, ebook) {
            const cardHtml = `
                <div class="col">
                    <div class="card h-100">
                        <img src="${ebook.image}" class="card-img-top" alt="${ebook.title}">
                        <div class="card-body">
                            <h5 class="card-title">${ebook.title}</h5>
                            <p class="card-text">${ebook.description}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="#" class="btn btn-primary">Read Now</a>
                            <a href="#" class="btn btn-outline-secondary ms-2">View Details</a>
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
