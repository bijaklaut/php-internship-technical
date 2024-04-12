<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="py-10 w-full max-w-[1024px] mx-auto px-10">
   <?php if (session()->getFlashdata('message')): ?>
      <div id="message-toast" class="w-full flex justify-between items-center rounded-md bg-sky-500 p-4">
         <span>
            <?= session()->getFlashdata('message') ?>
         </span>
         <button
            class="text-2xl w-9 h-9 flex items-center justify-center rounded-md hover:bg-black/30 transition-all duration-300"
            onclick="removeMessage()">
            <svg class="fill-current w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
               <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
               <g id="SVGRepo_iconCarrier">
                  <path
                     d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z">
                  </path>
               </g>
            </svg>
         </button>
      </div>
   <?php endif; ?>
   <h2 class="mt-5 mb-10 text-2xl font-semibold">Outlet Dashboard</h2>
   <a class="bg-sky-500 px-5 py-2 my-3 rounded-md text-sm" href="/outlet/add" role="button">Add Outlet</a>
   <?php if (count($outlets) > 0): ?>
      <table class="my-5 bg-white w-full text-black p-10 rounded-md">
         <thead>
            <tr class="[&>th]:py-5 [&>th:last]:w-[100px]">
               <th scope="col">#</th>
               <th scope="col">Kode Outlet</th>
               <th scope="col">Nama Outlet</th>
               <th scope="col">Alamat</th>
               <th scope="col">PIC</th>
               <th scope="col" class="w-[200px]">Action</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1 ?>
            <?php foreach ($outlets as $outlet): ?>
               <tr class="[&>*]:p-3 [&>*]:text-center">
                  <th scope="row"><?= ($pager->getCurrentPage() - 1) * count($outlets) + $i ?></th>
                  <td><?= $outlet['kode_outlet'] ?></td>
                  <td><?= $outlet['nama_outlet'] ?></td>
                  <td><?= $outlet['alamat'] ?></td>
                  <td><?= $outlet['pic'] ?></td>
                  <td class="w-[200px] flex items-center justify-center gap-1">
                     <a href="/outlet/<?= $outlet['id'] ?>" class="text-sm rounded-md px-3 py-1 bg-green-400">Update</a>
                     <form method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" data-outlet_id="<?= $outlet['id'] ?>" onclick="deleteOutlet()"
                           class="text-sm rounded-md px-3 py-1 bg-red-400">Delete</button>
                     </form>
                  </td>
               </tr>
               <?php
               $i++;
            endforeach;
            ?>
         </tbody>
      </table>
      <?= $pager->links('default', 'default') ?>
   <?php else: ?>
      <div class="mt-10 bg-white w-full text-center text-black p-10 rounded-md">Tidak ada data untuk ditampilkan</div>
   <?php endif ?>
</div>
<?= $this->endSection(); ?>