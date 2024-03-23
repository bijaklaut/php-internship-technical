<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$action = isset($outlet) ? 'updateoutlet' : 'addoutlet';
helper('form');

?>
<div class="pt-5 pb-10 w-full max-w-[600px] mx-auto px-10">
   <h2 class="mt-5 mb-10 text-2xl font-semibold"><?= $judul ?></h2>
   <div class="w-full mx-auto bg-zinc-800 p-5 rounded-md text-black">
      <form action="<?= base_url($action) ?>" method="post">
         <?= csrf_field() ?>
         <?php if (isset($outlet)) : ?>
            <input type="hidden" name="id" value="<?= $outlet['id'] ?>">
         <?php endif; ?>
         <div class="flex flex-col gap-2 mb-4">
            <label for="kode_outlet" class="text-white font-semibold">Kode Outlet</label>
            <input id="kode_outlet" type="text" class="py-1 px-2 rounded-md" name="kode_outlet" value="<?= old("kode_outlet", isset($outlet) ? $outlet["kode_outlet"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('kode_outlet') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4">
            <label for="nama_outlet" class="text-white font-semibold">Nama Outlet</label>
            <input id="nama_outlet" type="text" class="py-1 px-2 rounded-md" name="nama_outlet" value="<?= old("nama_outlet", isset($outlet) ? $outlet["nama_outlet"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('nama_outlet') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4">
            <label for="alamat" class="text-white font-semibold">Alamat</label>
            <input id="alamat" type="text" class="py-1 px-2 rounded-md" name="alamat" value="<?= old("alamat", isset($outlet) ? $outlet["alamat"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('alamat') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4">
            <label for="pic" class="text-white font-semibold">PIC</label>
            <input id="pic" type="text" class="py-1 px-2 rounded-md" name="pic" value="<?= old("pic", isset($outlet) ? $outlet["pic"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('pic') ?>
            </span>
         </div>
         <button type="submit" class="bg-sky-500 px-5 py-2 mt-8 mb-3 text-white flex w-fit mx-auto rounded-md text-sm">Add Outlet</button>
      </form>
   </div>
</div>
<?= $this->endSection(); ?>