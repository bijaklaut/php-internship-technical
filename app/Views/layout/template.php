<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="<?= base_url(); ?>/assets/css/output.css" rel="stylesheet">
   <title><?= $judul; ?></title>

</head>

<body class="bg-zinc-900 text-white">
   <nav class="w-full h-14 bg-sky-700 justify-center gap-5 flex items-center">
      <a href="/">
         Home
      </a>
      <a href="/outlet">
         Outlet
      </a>
      <a href="/barang">
         Barang
      </a>
      <a href="/penjualan">
         Penjualan
      </a>
   </nav>
   <main id="main" class="container-fluid">
      <?= $this->renderSection('content'); ?>
   </main>

   <script src="<?= base_url(); ?>/assets/js/jquery-3.6.0.min.js"></script>
   <script src="<?= base_url(); ?>/assets/js/script.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->
</body>

</html>