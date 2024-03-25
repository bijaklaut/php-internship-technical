<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$action = isset($penjualan) ? 'updatepenjualan' : 'addpenjualan';
helper('form');
// dd($penjualan)
?>
<div class="pt-5 pb-10 w-full max-w-[600px] mx-auto px-10">
   <h2 class="mt-5 mb-10 text-2xl font-semibold"><?= $judul ?></h2>
   <div class="w-full mx-auto bg-zinc-800 p-5 rounded-md text-black">
      <form action="<?= base_url($action) ?>" method="post">
         <?= csrf_field() ?>
         <?php if (isset($penjualan)) : ?>
            <input type="hidden" name="id" value="<?= $penjualan['id'] ?>">
            <input type="hidden" name="no_faktur" value="<?= $penjualan['no_faktur'] ?>">
         <?php endif; ?>
         <div class="flex flex-col gap-2 mb-4">
            <label for="tanggal_faktur" class="text-white font-semibold">Tanggal Faktur</label>
            <input id="tanggal_faktur" type="date" class="py-1 px-2 rounded-md" name="tanggal_faktur" value="<?= old("tanggal_faktur", isset($penjualan) ? $penjualan["tanggal_faktur"] : "") ?>">
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('tanggal_faktur') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4">
            <label for="kode_outlet" class="text-white font-semibold">Outlet</label>
            <select data-old="<?= old("kode_outlet", isset($penjualan) ? $penjualan["kode_outlet"] : "") ?>" name="kode_outlet" id="kode_outlet" class="bg-white py-1 px-2 rounded-md [&>*]:text-sm">
               <option value="null" selected disabled>Select outlet</option>
               <?php foreach ($outlets as $outlet) : ?>
                  <option value="<?= $outlet["kode_outlet"] ?>"><?= $outlet["nama_outlet"] . " - " . $outlet["kode_outlet"] ?></option>
               <?php endforeach; ?>
            </select>
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('kode_outlet') ?>
            </span>
         </div>
         <div class="flex flex-col gap-2 my-4 group relative">
            <label for="search_barang" class="text-white font-semibold">Barang</label>
            <input id="search_barang" type="text" placeholder="Cari barang" class="py-1 px-2 rounded-md peer" onkeyup="debounceFilterBarangs()">
            <?php if (isset($barangs)) : ?>
               <div id="list_barang" class="w-full bg-white absolute translate-y-[4.5rem] hidden flex-col gap-2 max-h-[300px] overflow-y-auto p-2 rounded-md shadow-md peer-focus:flex hover:flex">
                  <?php foreach ($barangs as $barang) : ?>
                     <label for="<?= 'option-' . $barang["kode_barang"] ?>" class="flex justify-between items-center p-1 text-sm">
                        <input type="checkbox" data-kode_barang="<?= $barang["kode_barang"] ?>" name="barang[<?= $barang['kode_barang'] ?>]" id="<?= 'option-' . $barang["kode_barang"] ?>" value="<?= $barang['harga'] ?>" class="hidden peer option-barang" data-old="<?= old("barang." . $barang["kode_barang"], isset($penjualan["barang"][$barang['kode_barang']]) ? $penjualan["barang"][$barang['kode_barang']] : "") ?>">

                        <span><?= $barang["nama_barang"] . " - Rp. " . number_format($barang['harga'], 0, ',', '.') ?></span>

                        <div class="h-5 w-5 rounded-full border flex items-center justify-center text-white border-black/40 transition-all duration-300 peer-checked:bg-sky-500">
                           <svg class="stroke-current h-[14px] w-[14px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                              <g id="SVGRepo_iconCarrier">
                                 <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                              </g>
                           </svg>
                        </div>
                     </label>
                  <?php endforeach ?>
               </div>
            <?php else : ?>
               <div class="w-full h-fit p-2 bg-white rounded-md text-center text-sm">Tidak ada barang untuk ditampilkan. Harap tambahkan barang terlebih dahulu</div>
            <?php endif; ?>
            <span class="invalid text-sm text-red-500">
               <?= validation_show_error('barang') ?>
            </span>
         </div>
         <div id="selected-barangs" class="hidden flex-col gap-2 my-4 max-h-[300px] overflow-y-auto">
            <h3 class="text-white font-semibold">Jumlah Barang</h3>
            <?php if (isset($barangs)) : ?>
               <?php foreach ($barangs as $barang) : ?>
                  <div id="<?= 'display-' . $barang['kode_barang'] ?>" class="w-full p-2 rounded-md bg-white hidden justify-between items-center">
                     <span><?= $barang["nama_barang"] . ' - Rp.' . number_format($barang["harga"], 0, ',', '.') ?></span>

                     <input type="number" min="0" data-harga="<?= $barang["harga"] ?>" name="qty[<?= $barang["kode_barang"] ?>]" id="qty-<?= $barang["kode_barang"] ?>" class="w-[80px] py-1 px-2 text-white bg-zinc-800 rounded-md qty-input" value="<?= old("qty." . $barang["kode_barang"], isset($penjualan["qty"][$barang["kode_barang"]]) ? $penjualan["qty"][$barang["kode_barang"]] : "") ?>">
                  </div>
               <?php endforeach ?>
            <?php endif; ?>
         </div>
         <div class="grid grid-cols-2 gap-3">
            <div class="flex flex-col gap-2 my-4">
               <label for="discount" class="text-white font-semibold">Discount</label>
               <input id="discount" min="0" max="0" type="number" class="py-1 px-2 rounded-md" name="discount" value="<?= old("discount", isset($penjualan) ? $penjualan["discount"] : "") ?>">
               <span class="invalid text-sm text-red-500">
                  <?= validation_show_error('discount') ?>
               </span>
            </div>
            <div class="flex flex-col gap-2 my-4">
               <label for="amount" class="text-white font-semibold">Amount</label>
               <input readonly id="amount" type="text" class="py-1 px-2 rounded-md" name="amount" value="<?= old("amount", isset($penjualan) ? $penjualan["amount"] : "") ?>">
               <span class="invalid text-sm text-red-500">
                  <?= validation_show_error('amount') ?>
               </span>
            </div>
         </div>
         <div class="grid grid-cols-2 gap-3">
            <div class="flex flex-col gap-2 my-4">
               <label for="ppn" class="text-white font-semibold">PPN (10%)</label>
               <input readonly id="ppn" type="text" class="py-1 px-2 rounded-md" name="ppn" value="<?= old("ppn", isset($penjualan) ? $penjualan["ppn"] : "") ?>">
               <span class="invalid text-sm text-red-500">
                  <?= validation_show_error('ppn') ?>
               </span>
            </div>
            <div class="flex flex-col gap-2 my-4">
               <label for="total_amount" class="text-white font-semibold">Total Amount</label>
               <input readonly id="total_amount" type="text" class="py-1 px-2 rounded-md" name="total_amount" value="<?= old("total_amount", isset($penjualan) ? $penjualan["total_amount"] : "") ?>">
               <span class="invalid text-sm text-red-500">
                  <?= validation_show_error('total_amount') ?>
               </span>
            </div>
         </div>
         <button type="submit" class="bg-sky-500 px-5 py-2 mt-8 mb-3 text-white flex w-fit mx-auto rounded-md text-sm">
            <?= (isset($penjualan)) ? "Perbaharui" : "Tambah Barang" ?>
         </button>
      </form>
   </div>
</div>
<?= $this->endSection(); ?>