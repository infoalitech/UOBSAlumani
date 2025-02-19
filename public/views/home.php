<?php
$title = 'UOBS Alumni';
include 'snippets/header.php';
?>
    <section id="hero" class="hero section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <div class="company-badge mb-4">
                <i class="bi bi-people-fill me-2"></i>
                Connecting Alumni, Creating Opportunities
              </div>

              <h1 class="mb-4">
                Welcome to <br>
                UOBS Alumni Corner <br>
                <span class="accent-text">Stay Connected, Stay Inspired</span>
              </h1>

              <p class="mb-4 mb-md-5">
                Join a thriving community of University of Baltistan graduates. Reconnect with peers, explore job opportunities, and stay updated with the latest news and events. Together, we build a stronger future.
              </p>

              <div class="hero-buttons">
                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Join Now</a>
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-link mt-2 mt-sm-0 glightbox">
                  <i class="bi bi-play-circle me-1"></i>
                  Watch Video
                </a>
              </div>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="https://uobs.edu.pk/images/convocations/2021/1.jpg" alt="Hero Image" class="img-fluid">

              <div class="customers-badge">
                <div class="customer-avatars">
                </div>
                <p class="mb-0 mt-2">12,000+ lorem ipsum dolor sit amet consectetur adipiscing elit</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Alumni Statistics Section -->
        <!-- <section id="alumni-stats" class="stats section"> -->
          <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row stats-row gy-4 mt-5">
              <!-- <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                  <div class="stat-icon">
                    <i class="bi bi-trophy"></i>
                  </div>
                  <div class="stat-content">
                    <h4>10+ International Awards</h4>
                    <p class="mb-0">Recognized alumni achievements</p>
                  </div>
                </div>
              </div> -->
              <div class="col-lg-4 col-md-6">
                <div class="stat-item">
                  <div class="stat-icon">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="stat-content">
                    <h4>1000+ Alumni </h4>
                    <p class="mb-0">Active and engaged alumni</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="stat-item">
                  <div class="stat-icon">
                    <i class="bi bi-briefcase"></i>
                  </div>
                  <div class="stat-content">
                    <h4>500+ Employed Graduates</h4>
                    <p class="mb-0">Successful career placements</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="stat-item">
                  <div class="stat-icon">
                    <i class="bi bi-mortarboard"></i>
                  </div>
                  <div class="stat-content">
                    <h4>100+ Higher Studies Scholars</h4>
                    <p class="mb-0">Alumni pursuing postgrad degrees</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- </section> -->

      </div>
    </section><!-- /Hero Section -->
    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 align-items-center justify-content-between">
          <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
            <span class="about-meta">ABOUT UOBS</span>
            <h2 class="about-title">Fifth Convocation 2022</h2>
            <p class="about-description">The University of Baltistan, Skardu, celebrated its Fifth Convocation in 2022, marking a significant milestone in its commitment to academic excellence and community development. The event honored the achievements of graduates and highlighted the university's dedication to fostering education in the region.</p>
            <p class="about-description">During the convocation, distinguished guests and faculty members addressed the graduates, emphasizing the importance of utilizing their education to contribute positively to society. The ceremony also showcased the university's growth, including the expansion of its campuses and the introduction of new academic programs.</p>
            <p class="about-description">The University of Baltistan continues to play a pivotal role in providing quality education and promoting research initiatives, aiming to empower students to become leaders in their respective fields.</p>
          </div>
          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="image-wrapper">
              <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                <img src="https://uobs.edu.pk/images/convocations/2022/3.jpg" alt="Convocation Ceremony" class="img-fluid main-image rounded-4">
                <img src="https://uobs.edu.pk/images/convocations/2022/1.jpg" alt="Graduation Event" class="img-fluid small-image rounded-4">
              </div>
              <div class="experience-badge floating">
                <h3>2022</h3>
                <p>Fifth Convocation of UOBS</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Blogs Section -->
    <section id="blogs" class="features section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Latest Blogs</h2>
        <p>Stay updated with the latest news, success stories, and insights from UOBS alumni.</p>
      </div>
      <div class="container">
        <div class="row">

          <?php foreach ($latestBlogs as $blog): ?>
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
                  <a href="<?= $basePath ?>/blogDetail.php?id=<?= $blog['id'] ?>" >
                    <div  class="button">Get Started</div>
                  </a>
                </div>

            </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- Features Cards Section -->
      <!-- <section id="features-cards" class="features-cards section">
        <div class="container">
          <div class="row gy-4">
            <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
              <div class="feature-box orange">
                <i class="bi bi-award"></i>
                <h4>Top Achievers</h4>
                <p>Our alumni have won prestigious awards in academia, research, and entrepreneurship.</p>
              </div>
            </div>
            <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
              <div class="feature-box blue">
                <i class="bi bi-people"></i>
                <h4>Global Alumni Network</h4>
                <p>With over 5000+ graduates worldwide, UOBS alumni are making an impact in various fields.</p>
              </div>
            </div>
            <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
              <div class="feature-box green">
                <i class="bi bi-briefcase"></i>
                <h4>Career Success</h4>
                <p>More than 2000+ alumni have secured jobs in top companies and organizations.</p>
              </div>
            </div>
            <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
              <div class="feature-box red">
                <i class="bi bi-mortarboard"></i>
                <h4>Higher Studies</h4>
                <p>Over 100 alumni have pursued further education in leading universities worldwide.</p>
              </div>
            </div>
          </div>
        </div>
      </section> -->

<!-- Features Section -->
<section id="features" class="features section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Explore Opportunities</h2>
    <p>Discover the latest updates, blogs, and job openings from the UOBS Alumni Network.</p>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="d-flex justify-content-center">
      <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
        <?php foreach ($jobtypes as $key => $jobtype): ?>
          <li class="nav-item">
            <a class="nav-link 
              <?php if ($key ==1 ): ?>
              active show
              <?php endif ?>
              
              " data-bs-toggle="tab" data-bs-target="#features-<?= $jobtype['id'] ?>">
              <h4><?= $jobtype['name'] ?></h4>
            </a>
          </li>
        <?php endforeach; ?>
        </li>
      </ul>
    </div>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
      <!-- Blogs Tab -->
      <?php foreach ($jobtypes as $key => $jobtype): ?>
        <div class="tab-pane fade 
              <?php if ($key ==1 ): ?>
                active show
              <?php endif ?>
            " id="features-<?= $jobtype['id'] ?>">
          <div class="row">
            <?php foreach ($latestJobs as $latestJob): ?>
              <?php if ($latestJob['type_id']  == $jobtype['id']): ?>   
                <div class="col-lg-4 col-md-6 mb-4 p-relative" data-aos="fade-up" data-aos-delay="100">
                  <div class="card">
                    <div class="accents">
                      <div class="acc-card"></div><div class="acc-card"></div><div class="acc-card"></div>
                      <div class="light"></div><div class="light sm"></div>
                      <div class="top-light"></div>
                    </div>
                    <div class="">
                        <?php if ($latestJob['image']){ ?>
                          <img src="<?= $basePath ?>/../<?php echo htmlspecialchars($latestJob['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($latestJob['title']) ?>">
                        <?php } else { ?>
                          <img src="https://uobs.edu.pk/images/main/sarfaranga.jpg" class="card-img-top" alt="<?= htmlspecialchars($latestJob['title']) ?>">
                        <?php } ?>
                        <h2 class="text-white"><?= htmlspecialchars($latestJob['title']) ?></h2>
                        <p class="text-white"><?= substr(htmlspecialchars($latestJob['description']), 0, 100) ?>...</p>
                        <p class="text-white"><?= substr(htmlspecialchars($latestJob['organization']), 0, 100) ?>...</p>
                        <a href="<?= $basePath ?>/blogDetail.php?id=<?= $latestJob['id'] ?>" >
                          <div  class="button">Get Started</div>
                        </a>
                    </div>
                  </div>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div><!-- End Blogs Tab -->
      <?php endforeach; ?>
      <!-- Job Categories Tab -->
      <div class="tab-pane fade" id="features-tab-2">
        <div class="row">
          <?php foreach ($jobCategories as $category): ?>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
              <div class="card h-100 text-center">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                  <p class="card-text">Explore job opportunities in <?= htmlspecialchars($category['name']) ?>.</p>
                  <a href="jobs.php?category=<?= $category['id'] ?>" class="btn btn-info">View Jobs</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div><!-- End Job Categories Tab -->

    </div>
  </div>
</section><!-- /Features Section -->

    <!-- Faq Section -->
    <section class="faq-9 faq section light-background" id="faq">

      <div class="container">
        <div class="row">
          <div class="col-lg-5" data-aos="fade-up">
            <h2 class="faq-title">Latest News & Updates</h2>
            <p class="faq-description">Stay informed with the most recent updates, events, and announcements from UOBS.</p>
            <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
              <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488Z" fill="currentColor"></path>
              </svg>
            </div>
          </div>
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
            <div class="faq-container">
              <?php foreach ($latestNews as $news): ?>
                  <div class="faq-item">
                    <h3><?= htmlspecialchars($news['name']) ?></h3>
                    <div class="faq-content">
                      <p><?= substr(htmlspecialchars($news['description']), 0, 150) ?>...</p>
                      <a href="<?= $basePath ?>/news/details?id=<?= $news['id'] ?>" class="btn btn-sm btn-primary mt-2">Read More</a>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                  </div>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </div>
    </section><!-- /Faq Section -->


<?php include 'snippets/footer.php'; ?>
