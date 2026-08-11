<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dua Sisi Money Changer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #000000;
        }

        .navbar .nav-link {
            color: #ffffff;
            margin-right: 15px;
        }

        .navbar .nav-link:hover {
            color: #00ff00;
        }

        .hero {
            background: url('hero-image.jpg') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero .overlay {
            background-color: rgba(0, 128, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero .content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.5rem;
            margin: 20px 0;
        }

        .icon-section {
            background-color: #000000;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .icon-section a {
            color: white;
            margin: 0 15px;
            font-size: 2rem;
        }

        .icon-section a:hover {
            color: #00ff00;
        }

        .about,
        .branches,
        .contact,
        .news {
            padding: 60px 0;
        }

        .about img,
        .branches img,
        .news img {
            max-width: 100%;
            border-radius: 5px;
        }

        .contact form .form-control {
            margin-bottom: 20px;
        }

        footer {
            background: black;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: white;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
        }

        .social-icons a:hover {
            color: #00ff00;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Dua Sisi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#branches">Branches</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Get in Touch</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">News</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="overlay"></div>
        <div class="content">
            <h1>Use Only Authorized Money Changer</h1>
            <p>Get in touch with us</p>
            <a href="#branches" class="btn btn-success">Branches</a>
        </div>
    </header>

    <!-- Icon Section -->
    <section class="icon-section">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
    </section>

    <!-- About Section -->
    <section id="about" class="about bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>About Us</h2>
                    <p>Dua Sisi Money Changer is an authorized money changer located in Jakarta and Surabaya. Operating since 1994, we serve customers with over 15 currencies, ensuring satisfaction and high-class service.</p>
                    <ul>
                        <li>USD, SGD, AUD, BND, CAD</li>
                        <li>CHY, EURO, GBP, HKD, JPY</li>
                        <li>MYR, NTD, SAR, THB & VND</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="about-image.jpg" alt="About Us" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Branches Section -->
    <section id="branches" class="branches">
        <div class="container">
            <h2 class="text-center">Branches</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="branch-image.jpg" alt="Branch" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h3>Dua Sisi KPO Plaza Asia</h3>
                    <p>Visit our branch at Plaza Asia for the best currency exchange services.</p>
                    <a href="https://wa.me/" class="btn btn-success">WhatsApp</a>
                    <a href="https://goo.gl/maps/" class="btn btn-secondary">Direction</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact bg-light">
        <div class="container">
            <h2 class="text-center">Get in Touch</h2>
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-md-4">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="WhatsApp No">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark">Send</button>
                </div>
            </form>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="news">
        <div class="container">
            <h2 class="text-center">Highlights News</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="news-image.jpg" alt="News" class="img-fluid">
                    <p>USD kembali menguat di awal perdagangan minggu ini.</p>
                    <a href="#">Read More &gt;&gt;</a>
                </div>
                <div class="col-md-6">
                    <img src="news-image.jpg" alt="News" class="img-fluid">
                    <p>USD kembali menguat di awal perdagangan minggu ini.</p>
                    <a href="#">Read More &gt;&gt;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; PT Tetra Dua Sisi 2025. All rights reserved.</p>
            <div class="social-icons">
                <a href="#" class="me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="me-3"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
