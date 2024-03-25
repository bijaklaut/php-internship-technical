<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="py-5 w-full max-w-[1536px] mx-auto px-20">
   <?php if (session()->getFlashdata('message')) : ?>
      <div id="message-toast" class="w-full flex justify-between items-center rounded-md p-4 <?= (session()->getFlashdata('message')[0] == 'success') ? 'bg-sky-500' : 'bg-red-500' ?>">
         <span>
            <?= session()->getFlashdata('message')[1] ?>
         </span>
         <button class="text-2xl w-9 h-9 flex items-center justify-center rounded-md hover:bg-black/30 transition-all duration-300" onclick="removeMessage()">
            <svg class="fill-current w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
               <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
               <g id="SVGRepo_iconCarrier">
                  <path d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z"></path>
               </g>
            </svg>
         </button>
      </div>
   <?php endif; ?>

   <h2 class="mt-5 mb-10 text-2xl font-semibold"><?= $judul ?></h2>

   <div class="w-full overflow-auto rounded-md">
      <table class="mt-5 bg-white w-full text-black p-10 rounded-md">
         <thead>
            <tr class="[&>th]:py-5 [&>th]:min-w-[100px]">
               <th scope="col">#</th>
               <th scope="col">No Faktur</th>
               <th scope="col">Kode Barang</th>
               <th scope="col">Quantity</th>
               <th scope="col">Harga</th>
               <th scope="col">Sub Total</th>
               <th scope="col">Created By</th>
               <th scope="col">Edit By</th>
               <th scope="col">Created At</th>
               <th scope="col">Updated At</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1 ?>
            <?php foreach ($details as $detail) : ?>
               <tr class="[&>*]:p-3 [&>*]:min-w-[100px] [&>*]:text-center">
                  <th scope="row"><?= $i ?></th>
                  <td><?= $detail['no_faktur'] ?></td>
                  <td><?= $detail['kode_barang'] ?></td>
                  <td><?= $detail['qty'] ?></td>
                  <td><?= "Rp. " . number_format($detail['harga'], 0, ',', '.') ?></td>
                  <td><?= "Rp. " . number_format($detail['sub_total'], 0, ',', '.') ?></td>
                  <td><?= $detail['created_user'] ?></td>
                  <td><?= $detail['edit_user'] ?></td>
                  <td><?= $detail['created_at'] ?></td>
                  <td><?= $detail['updated_at'] ?></td>
               </tr>
            <?php
               $i++;
            endforeach;
            ?>
         </tbody>
      </table>
   </div>
</div>
<?= $this->endSection(); ?>