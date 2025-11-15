<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/books.css'); ?>">
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
        <div class="row">
            <div class="col-md-4">
                <div class="book-cover <?php echo ($book['access_type'] == 'EXCLUSIVE') ? 'exclusive' : ''; ?>">
                    <img src="<?php echo base_url('img/covers/' . $book['cover_image_file']); ?>" class="img-fluid" alt="<?php echo $book['title']; ?>">
                    <?php if($book['access_type'] == 'EXCLUSIVE'): ?>
                        <span class="exclusive-badge">Exclusive</span>
                    <?php endif; ?>
                </div>
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
                <?php if(empty($enc_user_id)) { ?>
                                  <div class="alert alert-warning d-flex align-items-center">
                    <div>
                        <strong>Please login to start reading. dont have account? <a href="<?=base_url('index.php/auth/register');?>">register</a></strong>
                    </div></div>  

                <?php } elseif($has_access==true) { ?>
                    <a class="btn btn-primary btn-read" data-id="<?=$enc_book_id;?>">Read</a>
                    <?php if(!empty($occupy_msg)) { ?>
                        <div class="alert alert-danger mt-3">
                            <?php echo $occupy_msg; ?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                <div class="alert alert-warning d-flex align-items-center">
                    <div>
                        <strong>Donate to the uploader to gain access.</strong>
                        <?php if (!empty($book['donation_option_name']) && !empty($book['donation_target'])): ?>
                            <div class="small text-muted">
                                <?php echo htmlspecialchars($book['donation_option_name']); ?> target: <?php echo htmlspecialchars($book['donation_target']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($book['donation_info'])): ?>
                            <div class="mt-1"><?php echo htmlspecialchars($book['donation_info']); ?></div>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo base_url('index.php/public_profile/view/' . $book['username']); ?>" class="btn btn-sm btn-primary ms-auto">Donate / Contact Uploader</a>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Uploader Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo !empty($book['avatar_file']) ? base_url($book['avatar_file']) : base_url('img/avatar/user.png'); ?>" class="rounded-circle me-3" alt="<?php echo $book['username']; ?>" style="width: 50px; height: 50px;">
                            <div>
                                <h5><?php echo $book['full_name']; ?></h5>
                                <p class="text-muted">@<a href="<?php echo base_url('index.php/public_profile/view/' . $book['username']); ?>"><?php echo $book['username']; ?></a></p>
                                <?php if (!empty($book['donation_target'])): ?>
                                    <p><strong><?php echo $book['donation_option_name']; ?>:</strong> <?php echo $book['donation_target']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center mt-5">
        <div class="container">
            <span class="text-muted">© 2025 Libryon. All Rights Reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 for nicer alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

<script>
    const readerDomain = '<?php echo READER_DOMAIN; ?>';
    document.querySelector('.btn-read').addEventListener('click', function() {
        var bookId = this.getAttribute('data-id');
        var userId = '<?php echo $enc_user_id; ?>';

        var settings = {
            "url": "<?=base_url();?>index.php/public_shelf/updateReadingStatus",
            "method": "POST",
            "timeout": 5000,
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            "data": {
                "id": bookId,
                "kd": userId
            }
            };

            $.ajax(settings).done(function (response) {
                if(response.success) {
                    var readerUrl = readerDomain + 'weblander.html?id=' + encodeURIComponent(bookId) + '&kd=' + encodeURIComponent(userId);
                    window.open(readerUrl, '_blank');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            }).fail(function(){
                    console.log('r')
            });


    });
    //<?=READER_DOMAIN;?>weblander.html?id=x&kd=x
</script>