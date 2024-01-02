<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tambahkan tag head yang sesuai di sini -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css">
    <style>
        /* Tambahkan gaya kustom Anda di sini */
        .navbar {
            background-color: white;
            justify-content: space-between; /* Untuk membuat navbar tidak terlalu tengah */
        }
        .navbar .navbar-brand {
            color: black;
            margin-right: 20px; /* Menambahkan margin kanan agar tidak terlalu tengah */
        }
        .navbar .navbar-toggler {
            background-color: black;
            border: none;
            padding: 0;
        }
        .navbar .navbar-toggler-icon {
            font-size: 1.5rem; /* Ukuran ikon hamburger */
            color: black; /* Warna ikon hamburger */
        }
        .navbar .navbar-collapse .navbar-nav .nav-item .nav-link {
            color: black;
            border-bottom: 2px solid transparent; /* Garis bawah awalnya transparan */
            padding: 0.5rem 1rem;
        }
        .navbar .navbar-collapse .navbar-nav .nav-item.active .nav-link {
            color: #3498db; /* Warna teks aktif */
            background-color: white;
            border-color: #3498db; /* Garis bawah saat aktif */
        }
        .navbar .navbar-collapse .navbar-nav .nav-item .nav-link:hover {
            color: #3498db;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img style="height: 3em; width: 2em;" src="oil-clinic.png" alt="Oil Clinic">
                Oil Clinic
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news') }}"><i class="fas fa-newspaper"></i> News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-tools"></i> Our Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-envelope"></i> Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/js/mdb.min.js"></script>
    <script>
        // Mendapatkan URL halaman saat ini
        const currentPage = window.location.href;

        // Mendapatkan semua item menu
        const menuItems = document.querySelectorAll('.nav-item');

        // Mengecek setiap item menu
        menuItems.forEach((item) => {
            // Mendapatkan URL item menu
            const itemURL = item.querySelector('.nav-link').href;

            // Memeriksa apakah URL item menu sama dengan URL halaman saat ini
            if (currentPage === itemURL) {
                // Jika sama, tambahkan kelas "active"
                item.classList.add('active');
            }
        });
    </script>
</body>
</html>
