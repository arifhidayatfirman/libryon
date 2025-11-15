<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $user['username']; ?>'s Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f6f8;
      color: #222;
    }

    .navbar {
      box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }



    h1 {
      text-align: center;
      margin-bottom: 10px;
      color: #333;
    }

    .profile-info {
      text-align: center;
      border-bottom: 1px solid #eee;
      padding-bottom: 20px;
      margin-bottom: 30px;
    }

    .profile-info p {
      margin: 5px 0;
      color: #555;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 3px solid #007bff;
    }

    h2 {
      color: #444;
      margin-bottom: 15px;
      text-align: center;
    }

    .ebook-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .ebook-item {
      background: #fafafa;
      padding: 20px;
      border-radius: 12px;
      transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .ebook-item:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .ebook-item img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .ebook-item h3 {
      margin-top: 0;
      margin-bottom: 10px;
      text-align: center;
    }

    .ebook-item h3 a {
      text-decoration: none;
      color: #007bff;
      font-weight: 600;
    }

    .ebook-item p {
      font-size: 14px;
      color: #555;
      margin: 5px 0;
      text-align: center;
    }

    .read-button {
      display: inline-block;
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
      margin-top: 15px;
      transition: background-color 0.2s ease;
    }

    .read-button:hover {
      background-color: #0056b3;
    }

    @media (max-width: 600px) {

    }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('index.php/public_shelf'); ?>">Libryon</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/public_shelf'); ?>">Ebooks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/auth/profile'); ?>">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  <div class="container">
    <h1><?php echo $user['username']; ?>'s Profile</h1>
    <div class="profile-info">
      <?php if (!empty($user['avatar_file'])): ?>
        <img src="<?php echo base_url($user['avatar_file']); ?>" alt="Profile Picture" class="avatar">
      <?php else: ?>
        <img src="<?php echo base_url('img/avatar/user.png'); ?>" alt="Default Avatar" class="avatar">
      <?php endif; ?>
      <p><strong>Full Name:</strong> <?php echo $user['full_name']; ?></p>
      <?php if (!empty($user['bio'])): ?>
        <p><strong>Bio:</strong> <?php echo $user['bio']; ?></p>
      <?php endif; ?>
      <?php if (isset($user['donation_target'])): ?>
        <p><strong>E-wallet/Donation Target:</strong> <?php echo $user['donation_target']; ?></p>
      <?php endif; ?>
    </div>

    <h2>Uploaded Boooks</h2>
    <?php if (!empty($ebooks)): ?>
      <div id="ebooks-container" class="ebook-list">
        <?php foreach ($ebooks as $ebook): ?>
          <div class="ebook-item">
            <?php if (!empty($ebook['cover_image_file'])): ?>
              <img src="<?php echo base_url('img/covers/' . $ebook['cover_image_file']); ?>" alt="<?php echo $ebook['title']; ?> Cover">
            <?php else: ?>
              <img src="<?php echo base_url('img/default_book_cover.png'); ?>" alt="Default Book Cover">
            <?php endif; ?>
            <h3><a href="<?php echo base_url('public_shelf/view/' . $ebook['book_id']); ?>"><?php echo $ebook['title']; ?></a></h3>
            <p><strong>Author:</strong> <?php echo $ebook['author']; ?></p>
            <p><strong>Description:</strong> <?php echo word_limiter($ebook['description'], 20); ?></p>
            <a href="<?php echo base_url('public_shelf/view/' . $ebook['book_id']); ?>" class="read-button">Read</a>
          </div>
        <?php endforeach; ?>
      </div>
      <?php if ($total_ebooks > count($ebooks)): ?>
        <div style="text-align: center; margin-top: 30px;">
          <button id="load-more-btn" class="read-button">Load More</button>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <p style="text-align:center; color:#777;"><?php echo $user['username']; ?> has not uploaded any books yet.</p>
    <?php endif; ?>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let offset = <?php echo count($ebooks); ?>;
      const limit = <?php echo Public_profile::EBOOKS_PER_PAGE; ?>;
      const username = "<?php echo $user['username']; ?>";
      const ebooksContainer = document.getElementById('ebooks-container');
      const loadMoreBtn = document.getElementById('load-more-btn');

      if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
          fetch(`<?php echo base_url('public_profile/load_more_ebooks/'); ?>${username}?offset=${offset}`)
            .then(response => response.json())
            .then(data => {
              data.ebooks.forEach(ebook => {
                const ebookItem = `
                  <div class="ebook-item">
                    <img src="${ebook.cover_image_url}" alt="${ebook.title} Cover">
                    <h3><a href="${ebook.read_url}">${ebook.title}</a></h3>
                    <p><strong>Author:</strong> ${ebook.author}</p>
                    <p><strong>Description:</strong> ${ebook.description_limited}</p>
                    <a href="${ebook.read_url}" class="read-button">Read</a>
                  </div>
                `;
                ebooksContainer.insertAdjacentHTML('beforeend', ebookItem);
              });

              offset += data.ebooks.length;

              if (!data.has_more) {
                loadMoreBtn.style.display = 'none';
              }
            })
            .catch(error => console.error('Error loading more ebooks:', error));
        });
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
