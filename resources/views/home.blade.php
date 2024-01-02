@extends('layouts2.app')

@section('content')
<style>
    .jumbotron {

        background-color: whitesmoke;
        background-size: cover;
        background-position: center;
        color: black;
        text-align: center;
        width: 100%; /* Lebar jumbotron 200px */
        height: 880px; /* Tinggi jumbotron 200px */
    }

    .jumbotron h1 {
        font-size: 2rem;

    }

    .jumbotron p {
        font-size: 1rem;
    }

    .slideshow-container {
        position: center;
        max-width: 100%;
        margin: auto;
    }

    .mySlides {
        display: none;
    }

    .mySlides img {
        width: 100%;
        height: 680px;
    }

    .text {
        text-align: center;
        position: absolute;
        width: 100%;
        color: #f2f2f2;
        font-size: 15px;

    }

    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }
    html, body, .container-fluid {
    overflow-x: hidden;
}

.news-link {
    text-decoration: none;
}

.news-square {
    text-align: center;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 2px solid #3498db; /* Warna border */
    padding: 20px; /* Padding untuk memberi jarak antara teks dan border */
    text-align: center;
    margin: 10px 0; /* Margin antara setiap berita */
    transition: border-color 0.3s; /* Efek hover saat kursor di atasnya */
}

.news-square:hover {
    border-color: #f39c12; /* Warna border saat dihover */
}

.news-square h3 {
    font-size: 1.5rem;
    color: #333; /* Warna teks */
}

.news-square p {
    font-size: 1rem;
    color: #666; /* Warna teks */
}

.news-square a {
    color: #333; /* Warna tautan */
}

.news-square a:hover {
    color: #f39c12; /* Warna tautan saat dihover */
}

.news-item {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px 0;
    }


    .news-image {
        max-width: 100%;
        max-height: 100%;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Menampilkan berita sebaris dan wrap ke baris berikutnya jika ruang tidak cukup */
        gap: 20px; /* Jarak antara setiap berita */
    }

.col h2 {
    text-align: center;
}

.video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* Perbandingan aspek 16:9 */
        margin-top: 20px; /* Jarak antara video dan berita */
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .gallery-row {
        display: flex;
        flex-wrap: wrap;
        padding: 0 4px;
    }

    .gallery-column {
        flex: 25%;
        max-width: 25%;
        padding: 0 4px;
    }

    .gallery-column img {
        width: 100%;
        margin-top: 8px;
        cursor: pointer;
    }



    .gallery-container {
        position: relative;
        display: none;
    }

    #gallery-imgtext {
        position: absolute;
        bottom: 15px;
        left: 15px;
        color: white;
        font-size: 20px;
    }

    .gallery-closebtn {
        position: absolute;
        top: 10px;
        right: 15px;
        color: white;
        font-size: 35px;
        cursor: pointer;
    }
</style>



<div class="jumbotron">
    <h1>Welcome to Oil Clinic</h1>
    <p>Your Trusted Source for Oil-Related News</p>
    <div class="slideshow-container">
        <div class="mySlides">
            <img src="Jumbotron.jpg" alt="Slide 1">

        </div>

        <div class="mySlides">
            <img src="jumbotron2.jpg" alt="Slide 2">

        </div>

        <div class="mySlides">
            <img src="jumbotron3.jpeg" alt="Slide 3">

        </div>

        <!-- Tombol navigasi untuk slide -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <div style="text-align:center">
        <!-- Tombol navigasi titik -->
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Latest News</h2>
            <div class="news-grid">
                <a href="#" class="news-link">
                    <div class="news-square">
                        <img src="oilclinic-logo.png" alt="News Image 1" class="news-image">
                        <h3>News Title 1</h3>
                        <p>Caption or Description for News 1. This is a brief description of the news article.</p>
                    </div>
                </a>
                <a href="#" class="news-link">
                    <div class="news-square">
                        <img src="oilclinic-logo.png" alt="News Image 2" class="news-image">
                        <h3>News Title 2</h3>
                        <p>Caption or Description for News 2. This is a brief description of the news article.</p>
                    </div>
                </a>
                <a href="#" class="news-link">
                    <div class="news-square">
                        <img src="oilclinic-logo.png" alt="News Image 3" class="news-image">
                        <h3>News Title 3</h3>
                        <p>Caption or Description for News 3. This is a brief description of the news article.</p>
                    </div>
                </a>
            </div>
            <div class="row gallery-row">
                <div class="column gallery-column">
                    <img src="curug.jpg" alt="Gallery Image 1" onclick="openGallery('curug.jpg', 'Gallery Image 1')">
                </div>
                <div class="column gallery-column">
                    <img src="bromo.jpeg" alt="Gallery Image 2" onclick="openGallery('bromo.jpeg', 'Gallery Image 2')">
                </div>
                <div class="column gallery-column">
                    <img src="kalimatung.jpg" alt="Gallery Image 3" onclick="openGallery('kalimatung.jpg  ', 'Gallery Image 3')">
                </div>
                <!-- Tambahkan gambar gallery sesuai kebutuhan -->
            </div>

            <div class="container overlay" onclick="closeGallery()" id="gallery-overlay">
                <span onclick="closeGallery()" class="gallery-closebtn" title="Close Overlay">×</span>
                <img id="gallery-expandedImg" style="width:100%">
                <div id="gallery-imgtext"></div>
            </div>

            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/gDEKgBZnx3g" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides((slideIndex += n));
    }

    function currentSlide(n) {
        showSlides((slideIndex = n));
    }

    function showSlides(n) {
        let i;
        const slides = document.getElementsByClassName('mySlides');
        const dots = document.getElementsByClassName('dot');
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none';
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(' active', '');
        }
        slides[slideIndex - 1].style.display = 'block';
        dots[slideIndex - 1].className += ' active';
    }
    setInterval(function () {
        plusSlides(1); // Pindah ke slide berikutnya
    }, 3000); // Waktu dalam milidetik (3 detik)


    function openGallery(imgSrc, imgText) {
        document.getElementById('gallery-overlay').style.display = 'block';
        document.getElementById('gallery-expandedImg').src = imgSrc;
        document.getElementById('gallery-imgtext').innerHTML = imgText;
    }

    function closeGallery() {
        document.getElementById('gallery-overlay').style.display = 'none';
    }
</script>

@endsection
