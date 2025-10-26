<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebook Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .book-card {
            transition: transform 0.2s;
        }
        .book-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <header class="text-center mb-5">
            <h1>Ebook Collection</h1>
            <p class="lead">A curated collection of ebooks</p>
        </header>

        <main>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card book-card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 1</h5>
                            <p class="card-text">Author Name 1</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card book-card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 2</h5>
                            <p class="card-text">Author Name 2</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card book-card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 3</h5>
                            <p class="card-text">Author Name 3</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="text-center mt-5">
            <p>&copy; 2023 Ebook Collection</p>
        </footer>
    </div>
</body>
</html>