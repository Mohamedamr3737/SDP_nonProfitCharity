<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Basmah | Leave A story Behind</title>

        <!-- CSS FILES -->                
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/Assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Assets/css/bootstrap-icons.css">
        <link rel="stylesheet" href="/Assets/css/basmah.css">
        
    </head>
    
    <body>

        <main>

            <nav class="navbar navbar-expand-lg">                
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <img src="/Assets/images/logo (2).png" width="500px" class="navbar-brand-image img-fluid" alt="basmah">
                        <span class="navbar-brand-text">
                            Basmah
                            <small>Leave a story behind</small>
                        </span>
                    </a>

                    <div class="d-lg-none ms-auto me-3">
                        <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Member Login</a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_1">Home</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_2">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_3">Donations</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_4">Knowledge Quiz</a>
                            </li>

                        </ul>

                        <div class="d-none d-lg-block ms-lg-3">
                            <a class="btn  custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Member Login</a>
                        </div>

                        <div class="d-none d-lg-block ms-lg-3">
                            <a class="btn custom-btn  custom-border-btn"  href="/logout" role="button" >Logout</a>
                        </div>

                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'user'): ?>
                            <div class="d-none d-lg-block ms-lg-3">
                                <a class="btn custom-btn custom-border-btn" href="/admin/dashboard" role="button">Admin</a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </nav>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Member Area</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs " id="authTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="signup" aria-selected="false">Sign Up</button>
            </li>
        </ul>
        
        <!-- Tab Content -->
        <div class="tab-content mt-2" id="authTabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <!-- Include the login form -->
                <?php include '../views/auth/login.php'; ?>
                
            </div>
            <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                <!-- Include the signup form -->
                <?php include '../views/auth/signup.php'; ?>
            </div>
        </div>
    </div>

    <!-- Decorative SVG -->
    <svg class="background-svg" style="z-index: -100;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
    </svg>
</div>

            

            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

                <div class="section-overlay"></div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path></svg>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-7 col-12 mb-5 mb-lg-0">
                            <h2 class="text-white">Welcome to Basmah</h2>

                            <h1 class="cd-headline rotate-1 text-white mb-4 pb-2">
                                <span>Basmah is</span>
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">Hopeful</b>
                                    <b>Heartwarming</b>
                                    <b>Inspiring</b>
                                    <b>Kindness in Action</b>
                                </span>
                            </h1>
                        <span>


                        <?php
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        // Check if user is logged in
                        if (isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
                            // User is logged in, show welcome message
                            echo "<p style='color:white;'>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</p>";
                        } else {
                            // User is not logged in, show login prompt
                            echo "<p style='color:white;'>You are not logged in.</p>";
                        }
                        ?></span>

                            <div class="custom-btn-group">
                                <a href="#section_2" class="btn custom-btn smoothscroll me-3">Our Story</a>

                                <a href="/index.php?showSignUp=true" class="link smoothscroll">Become a member</a>
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <div class="ratio ratio-16x9">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/DbsvGVm4CJY?si=51s3Zn4s3npDnzId" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                            </div>
                        </div>

                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            </section>


            <section class="about-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">About Basmah</h2>
                        </div>

                        <div class="col-lg-5 col-12 me-auto mb-4 mb-lg-0">
                            <h3 class="mb-3">Basmah History</h3>

                            <p><strong>Since 1984</strong>, Basmah has been dedicated to uplifting lives and fostering hope within underserved communities.</p>

                            <p>Basmah’s mission focuses on empowering individuals through access to food, clean water, healthcare, and education. Thanks to our committed volunteers and supporters, Basmah has made a meaningful difference in the lives of countless families around the world.</p>

                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-0">
                            <div class="member-block">
                                <div class="member-block-image-wrap">
                                    <img src="/Assets/images/members/portrait-young-handsome-businessman-wearing-suit-standing-with-crossed-arms-with-isolated-studio-white-background.jpg" class="member-block-image img-fluid" alt="">

                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="member-block-info d-flex align-items-center">
                                    <h4>Michael</h4>

                                    <p class="ms-auto">Founder</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="member-block">
                                <div class="member-block-image-wrap">
                                    <img src="/Assets/images/members/successful-asian-lady-boss-red-blazer-holding-clipboard-with-documens-pen-working-looking-happy-white-background.jpg" class="member-block-image img-fluid" alt="">

                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-linkedin"></a>
                                        </li>
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="member-block-info d-flex align-items-center">
                                    <h4>Sandy</h4>

                                    <p class="ms-auto">Co-Founder</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="section-bg-image">
                <svg viewBox="0 0 1265 144" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="rgba(255, 255, 255, 1)" d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z" stroke-width="0"></path></svg>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="section-bg-image-block">
                                <h2 class="mb-lg-3">Get our newsletter</h2>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore et dolore.</p>

                                <form action="#" method="get" class="custom-form mt-lg-4 mt-2" role="form">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bi-envelope" id="basic-addon1"></span>

                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">

                                        <button type="submit" class="form-control">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <svg viewBox="0 0 1265 144" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="rgba(255, 255, 255, 1)" d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z" stroke-width="0"></path></svg>
            </section>


            <section class="membership-section section-padding" id="section_3">
                <div class="container">
                <div class="recent" id="recent-donation-message"></div>

                    <div class="row">

                        <div class="col-lg-12 col-12 text-center mx-auto mb-lg-5 mb-4">
                            <div class="row">
                            <?php include '../views/donation/create.php'; ?>
                            </div>
                        </div>


                        


                    </div>
                </div>
            </section>


            <section class="quiz-section" id="section_4">
            <svg viewBox="0 0 1265 144" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="rgba(255, 255, 255, 1)" d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z" stroke-width="0"></path></svg>

                <div class="section-overlay"></div>
                <div class="container">
                    <div class="row">
                        <?php include '../views/game/game.php'; ?>
                    </div>
                </div>

                <svg viewBox="0 0 1265 144" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="rgba(255, 255, 255, 1)" d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z" stroke-width="0"></path></svg>

            </section>




        </main>

        <section id="events" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center mb-lg-5 mb-4">
                <h2>Upcoming Events</h2>
            </div>

            <?php
            // Get the future events as an array
            $futureEvents = $eventController->getFutureEvents();

            // Initialize the EventIterator
            $eventIterator = new EventIterator($futureEvents);

            // Use the EventIterator to loop through events
            for ($eventIterator->rewind(); $eventIterator->valid(); $eventIterator->next()) {
                $event = $eventIterator->current();
            ?>
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['name']); ?></h5>
                            <p class="card-text"><strong>Date:</strong> <?= htmlspecialchars($event['date']); ?></p>
                            <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($event['location']); ?></p>
                            <form action="/events/register" method="POST">
                                <input type="hidden" name="event_id" value="<?= $event['id']; ?>">
                                <button type="submit" class="btn btn-primary">Attend</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success_message']); ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php elseif (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error_message']); ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
    </div>
</section>




        <footer class="site-footer">
            <div class="container">
                <div class="row mt-5">

                    <div class="col-lg-6 col-12 me-auto mb-5 mb-lg-0">
                        <a class="navbar-brand d-flex align-items-center" href="index.html">
                            <img src="/Assets/images/logo (2).png" class="navbar-brand-image img-fluid" alt="">
                            <span class="navbar-brand-text">
                                Basmah
                                <small>Leave A Story Behind</small>
                            </span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-12">
                        <h5 class="site-footer-title mb-4">Join Us</h5>

                        <p class="d-flex border-bottom pb-3 mb-3 me-lg-3">
                            <span>Mon-Fri</span>
                            6:00 AM - 6:00 PM
                        </p>

                        <p class="d-flex me-lg-3">
                            <span>Sat-Sun</span>
                            6:30 AM - 8:30 PM
                        </p>
                        <br>
                        <p class="copyright-text">Copyright © 2024 Basmah</p>
                    </div>

                        <div class="col-lg-2 col-12 ms-auto">
                            <ul class="social-icon mt-lg-5 mt-3 mb-4">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-whatsapp"></a>
                                </li>
                            </ul>
                            
                        </div>

                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#81B29A" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
        </footer>


        <!-- JAVASCRIPT FILES -->
        <script src="/Assets/js/jquery.min.js"></script>
        <script src="/Assets/js/bootstrap.bundle.min.js"></script>
        <script src="/Assets/js/jquery.sticky.js"></script>
        <!-- <script src="/Assets/js/click-scroll.js"></script> -->
        <script src="/Assets/js/animated-headline.js"></script>
        <script src="/Assets/js/modernizr.js"></script>
        <script src="/Assets/js/custom.js"></script>
        <script>
document.addEventListener("DOMContentLoaded", function() {
    // Check if URL contains 'showLogin' parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('showLogin')) {
        // Open the offcanvas
        const offcanvasElement = new bootstrap.Offcanvas(document.getElementById('offcanvasExample'));
        offcanvasElement.show();

        // Activate the login tab
        const loginTab = document.getElementById('login-tab');
        const loginContent = new bootstrap.Tab(loginTab);
        loginContent.show();
    }else if(urlParams.has('showSignUp')){
        // Open the offcanvas
        const offcanvasElement = new bootstrap.Offcanvas(document.getElementById('offcanvasExample'));
        offcanvasElement.show();

        // Activate the login tab
        const loginTab = document.getElementById('signup-tab');
        const loginContent = new bootstrap.Tab(loginTab);
        loginContent.show();
    }



});
</script>


    </body>
</html>