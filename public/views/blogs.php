<?php
$title = 'Blogs';
include 'snippets/header.php';
?>
<?php
$title = 'Job Opportunities';
include 'snippets/header.php';
?>
<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
    <h1>Blogs</h1>
    <p>Discover the latest updates, blogs, and job openings from the UOBS Alumni Network.</p>
    </div>
</div><!-- End Page Title -->


    <!-- Blogs Section -->
    <section id="blogs" class="features section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Latest Blogs</h2>
        <p>Stay updated with the latest news, success stories, and insights from UOBS alumni.</p>
      </div>
      <div class="container">
        <div class="row">

          <?php foreach ($blogs as $blog): ?>
            <div class="col-lg-4 col-md-6 mb-4 p-relative" data-aos="fade-up" data-aos-delay="100">

              <div class="card">
                <div class="accents">
                  <div class="acc-card"></div><div class="acc-card"></div><div class="acc-card"></div>
                  <div class="light"></div><div class="light sm"></div>
                  <div class="top-light"></div>
                </div>
                <div class="">
                    <?php if ($blog['cover']){ ?>
                      <img src="<?= $basePath ?>/../<?php echo htmlspecialchars($blog['cover']); ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>">
                    <?php } else { ?>
                      <img src="https://uobs.edu.pk/images/main/sarfaranga.jpg" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>">
                    <?php } ?>
                  <h2 class="text-white"><?= htmlspecialchars($blog['title']) ?></h2>
                  <p class="text-white"><?= substr(htmlspecialchars($blog['description']), 0, 100) ?>...</p>
                  <a href="<?= $basePath ?>/blogs/details?id=<?= $blog['id'] ?>" >
                    <div  class="button">Read More</div>
                  </a>
                </div>

            </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


<?php include 'snippets/footer.php'; ?>
