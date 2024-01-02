@extends('layouts2.app')

@section('content')
<style>

    /* News Grid Styles */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Satu baris terdiri dari tiga kolom */
        gap: 20px; /* Jarak antar elemen */
    }

    /* News Square Styles */
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

    /* News Square Content Styles */
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

    /* News Image Styles */
    .news-image {
        max-width: 100%;
        max-height: 100%;
    }

.h2 {
    text-align: center;
}

</style>

    <h2>News</h2>
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="news-grid">
                    @for ($i = 1; $i <= 9; $i++)
                        <div class="news-item">
                            <div class="news-square">
                                <img src="oilclinic-logo.png" alt="News Image {{ $i }}" class="news-image">
                                <h3>News Title {{ $i }}</h3>
                                <p>Caption or Description for News {{ $i }}. This is a brief description of the news article.</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

@endsection
