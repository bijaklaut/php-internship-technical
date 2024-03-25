<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div class="py-5 w-full h-screen flex justify-center items-center max-w-[1024px] mx-auto px-20">

    <div class="flex flex-col items-center justify-center gap-5">
        <h1 class="text-2xl font-semibold">PHP Internship Technical Test</h1>
        <h3 class="text-lg">Hudaa Eka Saputra</h3>
        <nav class="w-full justify-center bg-white/20 rounded-md p-2 mt-3 gap-5 flex items-center">
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
    </div>
</div>
<?= $this->endSection(); ?>