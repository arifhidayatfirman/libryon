<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to Libryon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		body {
			background-color: #f2f2f2;
			font: 16px/24px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		#container {
			margin-top: 50px;
			background-color: #fff;
			padding: 20px;
			text-align: center;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
		}
		h1 {
			color: #444;
			font-size: 28px;
			font-weight: normal;
			margin: 0 0 14px 0;
		}
		p {
			margin: 0 0 10px;
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
                        <a class="nav-link" href="/libryon/index.php/public_shelf">Ebooks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/libryon/index.php/auth/profile">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	<div class="container" id="container">
		<h1>Welcome to Libryon!</h1>
		<p>Your personal ebook library.</p>
		<p>Discover and read a wide variety of ebooks.</p>
		<form action="/libryon/index.php/public_shelf/search" method="get" class="d-flex" role="search">
			<input class="form-control me-2" type="search" name="q" placeholder="Search for ebooks" aria-label="Search">
			<button class="btn btn-outline-success" type="submit">Search</button>
		</form>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
