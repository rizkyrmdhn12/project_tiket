<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tailwind Starter</title>
  <!--
    Cara pakai (online):
    1) Cukup paste file ini ke CodePen / JSFiddle / StackBlitz / VS Code Live Server.
    2) Tailwind Play CDN sudah disertakan (untuk prototyping). Untuk produksi, disarankan build dengan CLI.
  -->

  <!-- Tailwind Play CDN (untuk prototyping) -->
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
  <!-- Header -->
  <header class="sticky top-0 z-50 bg-white/70 dark:bg-gray-900/70 backdrop-blur border-b border-gray-200/70 dark:border-gray-800">
    <div class="container flex items-center justify-between py-3">
      <a href="#" class="text-lg font-semibold tracking-tight">Brand</a>
      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="#" class="hover:text-indigo-600">Home</a>
        <a href="#" class="hover:text-indigo-600">Docs</a>
        <a href="#" class="hover:text-indigo-600">About</a>
      </nav>
      <div class="flex items-center gap-2">
        <button id="themeToggle" class="px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm text-sm">
          <span class="md:inline">🌙/☀️</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Main -->
  <main class="container py-10">
    <section class="grid md:grid-cols-2 gap-8 items-center">
      <div>
        <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Starter</p>
        <h1 class="mt-2 text-4xl md:text-5xl font-extrabold tracking-tight">Hello Tailwind</h1>
        <p class="mt-3 text-gray-600 dark:text-gray-300">Template HTML minimal dengan Tailwind Play CDN. Mulai kembangkan komponenmu di sini.</p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a href="#" class="inline-flex items-center px-4 py-2 rounded-2xl bg-indigo-600 text-white shadow hover:bg-indigo-700 active:scale-[.98] transition">
            Tombol Utama
          </a>
          <a href="#" class="inline-flex items-center px-4 py-2 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-indigo-300 dark:hover:border-indigo-500 transition">
            Tombol Sekunder
          </a>
        </div>
      </div>

      <div class="p-6 rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-800 shadow-sm">
        <h2 class="text-xl font-semibold">Contoh Card + Form</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Komponen kecil untuk uji styling.</p>
        <form class="mt-4 grid gap-3">
          <label class="text-sm font-medium">Email
            <input type="email" placeholder="you@example.com" class="mt-1 w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
          </label>
          <label class="text-sm font-medium">Password
            <input type="password" placeholder="••••••••" class="mt-1 w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
          </label>
          <button type="submit" class="mt-2 inline-flex items-center justify-center px-4 py-2 rounded-2xl bg-indigo-600 text-white shadow hover:bg-indigo-700 transition">Masuk</button>
        </form>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="container py-10 text-sm text-gray-500 dark:text-gray-400">
    <p>© <span id="y"></span> Tailwind Starter. Dibuat untuk prototyping cepat.</p>
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
