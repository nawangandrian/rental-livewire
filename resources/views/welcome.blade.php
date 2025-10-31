<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel Rentals | Tailwind Landing Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/app.css')
  <style>
    html { scroll-behavior: smooth; }
    .gradient-bg {
      background: linear-gradient(135deg, #ff512f, #dd2476);
    }
  </style>
</head>
<body class="antialiased text-gray-800 bg-gray-50">

  <!-- Navbar -->
<header class="fixed w-full top-0 bg-white/80 backdrop-blur-md shadow-sm z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Logo -->
    <h1 class="text-2xl font-bold text-pink-600">
      Laravel<span class="text-gray-800">Rentals</span>
    </h1>

    <!-- Menu Navigation -->
    <nav class="space-x-6 hidden md:flex">
      <a href="#home" class="hover:text-pink-600 font-medium transition">Home</a>
      <a href="#features" class="hover:text-pink-600 font-medium transition">Fitur</a>
      <a href="#contact" class="hover:text-pink-600 font-medium transition">Kontak</a>
    </nav>

    <!-- Auth Buttons -->
    @if (Route::has('login'))
      <div class="flex items-center space-x-3">
        @auth
          <!-- Dashboard Button -->
          <a 
            href="{{ url('/dashboard') }}" 
            class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition"
          >
            Dashboard
          </a>
        @else
          <!-- Login Button -->
          <a 
            href="{{ route('login') }}" 
            class="px-4 py-2 border border-pink-600 text-pink-600 rounded-md hover:bg-pink-600 hover:text-white transition"
          >
            Login
          </a>
          <!-- Register Button -->
          @if (Route::has('register'))
            <a 
              href="{{ route('register') }}" 
              class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition"
            >
              Daftar
            </a>
          @endif
        @endauth
      </div>
    @endif
  </div>
</header>


  <!-- Hero -->
        <section id="home" class="pt-32 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 items-center gap-10">
            <!-- Left -->
            <div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                Bisnis Rental Barang dengan <span class="text-pink-600">Laravel Rentals</span>
            </h2>
            <p class="text-gray-600 mb-8 text-lg">
                Sistem manajemen rental berbasis Laravel & Livewire untuk mengatur pelanggan, item, transaksi, dan dashboard
                dengan cepat dan efisien — semua dalam satu dashboard modern.
            </p>
            <form class="flex max-w-md">
                <input
                type="email"
                placeholder="Masukkan email kamu"
                class="flex-grow border border-gray-300 rounded-l-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                
                >
                <!-- Tombol Masuk -->
                <div class="flex max-w-md">
                <a 
                    href="{{ route('login') }}" 
                    class="flex-grow text-center bg-pink-600 text-white px-6 py-3 rounded-md hover:bg-pink-700 transition"
                >
                    Masuk
                </a>
                </div>
            </form>
            </div>

            <!-- Right (images grid) -->
            <div class="grid grid-cols-2 gap-4">
            <img src="https://images.unsplash.com/photo-1626177112300-33be79092667?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=465" class="rounded-xl shadow-md" alt="Rental Items">
            <img src="https://images.unsplash.com/photo-1677530410699-f692c94cf806?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8ZnJlZSUyMGltYWdlcyUyMG9nJTIwZWxlY3Ryb25pY3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=500" class="rounded-xl shadow-md mt-6" alt="Inventory">
            </div>
        </div>
        </section>

  <!-- Features -->
    <section id="features" class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h3 class="text-3xl font-bold mb-12">Fitur Unggulan Sistem Rental Barang</h3>
        <div class="grid md:grid-cols-3 gap-8">

        <!-- Dashboard -->
        <div class="p-8 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-pink-600 text-4xl mb-4">📊</div>
            <h4 class="text-xl font-semibold mb-2">Dashboard Interaktif</h4>
            <p class="text-gray-600">
            Menampilkan total pelanggan, total item, rental aktif, dan pendapatan secara real-time.
            </p>
        </div>

        <!-- Rental Terbaru -->
        <div class="p-8 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-pink-600 text-4xl mb-4">🕒</div>
            <h4 class="text-xl font-semibold mb-2">Rental Terbaru</h4>
            <p class="text-gray-600">
            Pantau transaksi rental terbaru lengkap dengan status penyewaan (Rented / Returned).
            </p>
        </div>

        <!-- Grafik Tren -->
        <div class="p-8 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-pink-600 text-4xl mb-4">📈</div>
            <h4 class="text-xl font-semibold mb-2">Grafik Tren Rental</h4>
            <p class="text-gray-600">
            Analisis performa bisnis dengan grafik tren rental 7 hari terakhir menggunakan Chart.js.
            </p>
        </div>

        <!-- Manajemen Pelanggan -->
        <div class="p-8 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-pink-600 text-4xl mb-4">👥</div>
            <h4 class="text-xl font-semibold mb-2">Manajemen Pelanggan</h4>
            <p class="text-gray-600">
            Tambah, ubah, dan hapus data pelanggan dengan mudah melalui antarmuka interaktif.
            </p>
        </div>

        <!-- Manajemen Item -->
        <div class="p-8 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-pink-600 text-4xl mb-4">📦</div>
            <h4 class="text-xl font-semibold mb-2">Manajemen Item</h4>
            <p class="text-gray-600">
            Kelola data item yang disewakan — lengkap dengan harga, stok, dan status ketersediaan.
            </p>
        </div>

        <!-- Manajemen Rental -->
        <div class="p-8 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-pink-600 text-4xl mb-4">🔑</div>
            <h4 class="text-xl font-semibold mb-2">Manajemen Rental</h4>
            <p class="text-gray-600">
            Kelola data penyewaan barang, durasi sewa, dan pengembalian secara cepat dan akurat.
            </p>
        </div>

        </div>
    </div>
    </section>

  <!-- CTA (Call To Action) -->
<section class="py-16 gradient-bg text-white text-center">
  <div class="max-w-3xl mx-auto px-6">
    <h3 class="text-3xl font-bold mb-4">Kelola Bisnis Rentalmu Lebih Mudah 🚀</h3>
    <p class="mb-8 text-lg opacity-90">
      Gunakan <span class="font-semibold">Laravel Rentals</span> untuk mengatur pelanggan, item, dan transaksi rental secara cepat dan efisien.
    </p>

    @if (Route::has('login'))
      @auth
        <a 
          href="{{ url('/dashboard') }}" 
          class="bg-white text-pink-600 px-6 py-3 rounded-md font-semibold hover:bg-pink-100 transition"
        >
          Buka Dashboard
        </a>
      @else
        <a 
          href="{{ route('register') }}" 
          class="bg-white text-pink-600 px-6 py-3 rounded-md font-semibold hover:bg-pink-100 transition"
        >
          Daftar Sekarang
        </a>
        <a 
          href="{{ route('login') }}" 
          class="border border-white text-white px-6 py-3 rounded-md font-semibold hover:bg-white hover:text-pink-600 transition ml-3"
        >
          Masuk
        </a>
      @endauth
    @endif
  </div>
</section>


  <!-- Footer -->
  <footer id="contact" class="bg-gray-900 text-gray-400 py-8">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
      <div class="mb-4 md:mb-0 text-center md:text-left">
        <h1 class="text-xl font-bold text-white">LaravelRentals</h1>
        <p class="text-gray-500 text-sm">© {{ date('Y') }} Dibuat dengan ❤️ menggunakan Laravel, Livewire, & TailwindCSS.</p>
      </div>
      <div class="space-x-4 text-sm">
        <a href="#home" class="hover:text-white">Home</a>
        <a href="#features" class="hover:text-white">Fitur</a>
        <a href="#contact" class="hover:text-white">Kontak</a>
      </div>
    </div>
  </footer>

</body>
</html>
