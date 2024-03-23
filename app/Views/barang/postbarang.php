<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$action = isset($barang) ? 'updatebarang' : 'addbarang';
helper('form');

?>
<div class="pt-5 pb-10 w-full max-w-[600px] mx-auto px-10">
   <h2 class="mt-5 mb-10 text-2xl font-semibold"><?= $judul ?></h2>
   <div class="w-full mx-auto bg-zinc-800 p-5 rounded-md text-black">
      <form action="<?= base_url($action) ?>" method="post">
         <?= csrf_field() ?>
         <?php if (isset($barang)) : ?>
            <input type="hidden" name="id" value="<?= $barang['id'] ?>">
         <?php endif; ?>
         <div class="flex flex-col gap-2 mb-4">
            <label for="kode_barang" class="text-white font-semibold">Kode Barang</label>
            <input id="kode_barang" type="text" class="py-1 px-2 rounded-md" name="kode_barang" value="<?= old("kode_barang", isset($barang) ? $barang["kode_barang"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('kode_barang') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4">
            <label for="nama_barang" class="text-white font-semibold">Nama Barang</label>
            <input id="nama_barang" type="text" class="py-1 px-2 rounded-md" name="nama_barang" value="<?= old("nama_barang", isset($barang) ? $barang["nama_barang"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('nama_barang') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4">
            <label for="harga" class="text-white font-semibold">Harga</label>
            <input id="harga" type="number" class="py-1 px-2 rounded-md" name="harga" value="<?= old("harga", isset($barang) ? $barang["harga"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('harga') ?>
            </span>
         </div>
         <button type="submit" class="bg-sky-500 px-5 py-2 mt-8 mb-3 text-white flex w-fit mx-auto rounded-md text-sm">
            <?= (isset($barang)) ? "Perbaharui" : "Tambah Barang" ?>
         </button>
      </form>
   </div>
</div>
<?= $this->endSection(); ?>