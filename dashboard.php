<?php

session_start();

// Cek apakah sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: index.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard | FLIGHTREL</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          container: { center: true, padding: '1rem' },
          fontFamily: {
            sans: ["Inter", "ui-sans-serif", "system-ui", "-apple-system", "Segoe UI", "Roboto", "Noto Sans", "Ubuntu", "Cantarell", "Helvetica Neue", "Arial", ""],
          },
        },
      },
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

  <header class="sticky top-0 z-50 bg-white/70 dark:bg-gray-900/70 backdrop-blur border-b border-gray-200/70 dark:border-gray-800">
    <div class="container flex items-center justify-between py-3">
      <a href="dashboard.php" class="text-lg font-semibold tracking-tight">FLIGHTREL</a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="#" class="hover:text-indigo-600 transition">Beranda</a>
        <a href="#" class="hover:text-indigo-600 transition">Pesan Tiket</a>
        <a href="#" class="hover:text-indigo-600 transition">Riwayat</a>
        <a href="#" class="hover:text-indigo-600 transition">Bantuan</a>
      </nav>
      <div class="flex items-center gap-2">
        <span class="text-sm font-medium hidden sm:inline-block">Apa Kabar, <?= htmlspecialchars($username) ?></span>
        <a href="controllers/logout.php" class="px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition">
          Logout
        </a>
        <button id="themeToggle" class="px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm text-sm">
          <span class="md:inline">🌙/☀️</span>
        </button>
      </div>
    </div>
  </header>

  <main class="container py-10">
    <section class="p-6 rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-800 shadow-sm">
      <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Dashboard Utama</h1>
      <p class="mt-2 text-gray-600 dark:text-gray-300">Selamat datang kembali, **<?= htmlspecialchars($username) ?>**! Ini adalah halaman dashboard Anda.</p>
    </section>
  </main>

  <footer class="container py-10 text-sm text-gray-500 dark:text-gray-400">
    <p>© <span id="y"></span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, autem.</p>
  </footer>

  <script>
    // Dark mode toggle + persist
    const root = document.documentElement
    const stored = localStorage.getItem('theme')
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
    if (stored === 'dark' || (!stored && prefersDark)) root.classList.add('dark')
    document.getElementById('themeToggle').addEventListener('click', () => {
      root.classList.toggle('dark')
      localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light')
    })
    // Tahun footer
    document.getElementById('y').textContent = new Date().getFullYear()
  </script>
</body>
</html>