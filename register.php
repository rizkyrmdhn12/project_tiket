<?php
include_once 'controllers/proses_register.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar | FLIGHTREL</title>

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
      <a href="#" class="text-lg font-semibold tracking-tight">FLIGHTREL</a>
      <div class="flex items-center gap-2">
        <button id="themeToggle" class="px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm text-sm">
          <span class="md:inline">🌙/☀️</span>
        </button>
      </div>
    </div>
  </header>

  <main class="container py-10">
    <section class="grid md:grid-cols-2 gap-8 items-center">
      <div>
        <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Daftar</p>
        <h1 class="mt-2 text-4xl md:text-5xl font-extrabold tracking-tight">Selamat Datang di FLIGHTREL</h1>
        <p class="mt-3 text-gray-600 dark:text-gray-300">Platform Pembelian Tiket Pesawat dan Kereta Api</p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a href="index.php" class="inline-flex items-center px-4 py-2 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-indigo-300 dark:hover:border-indigo-500 transition">
            Login
          </a>
        </div>
      </div>

      <div class="p-6 rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-800 shadow-sm">
        <h2 class="text-xl font-semibold">DAFTAR</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Buat Akun Baru</p>
        
        <?php if (!empty($register_message)): ?>
            <p class="mt-4 text-sm font-medium <?= strpos($register_message, 'berhasil') !== false ? 'text-green-500' : 'text-red-500' ?>">
                <?= $register_message ?>
            </p>
        <?php endif; ?>

        <form action="register.php" method="POST" class="mt-4 grid gap-3">
          <label class="text-sm font-medium">Username
            <input type="text" name="username" placeholder="Masukkan username Anda" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" class="mt-1 w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" required />
          </label>
          <label class="text-sm font-medium">Password
            <input type="password" name="password" placeholder="••••••••" class="mt-1 w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" required />
          </label>
          <button type="submit" name="register" class="mt-2 inline-flex items-center justify-center px-4 py-2 rounded-2xl bg-indigo-600 text-white shadow hover:bg-indigo-700 transition">Daftar Sekarang</button>
        </form>
        
        <div class="mt-4 text-sm text-gray-600 dark:text-gray-300">
            Sudah punya akun? <a href="login.php" class="text-indigo-500 hover:underline">Login</a>
        </div>
      </div>
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