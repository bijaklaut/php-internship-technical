<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="py-5 w-full max-w-[1024px] mx-auto px-10">
   <?php if (session()->getFlashdata('message')) : ?>
      <div class="w-full rounded-md bg-sky-500 p-4">
         <?= session()->getFlashdata('message') ?>
      </div>
   <?php endif; ?>
   <h2 class="mt-5 mb-10 text-2xl font-semibold">Outlet Dashboard</h2>
   <a class="bg-sky-500 px-5 py-2 my-3 rounded-md text-sm" href="/outlet/add" role="button">Add Outlet</a>
   <?php if (count($outlets) > 0) : ?>
      <table class="mt-5 bg-white w-full text-black p-10 rounded-md">
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
            <?php foreach ($outlets as $outlet) : ?>
               <tr class="[&>*]:p-3 [&>*]:text-center">
                  <th scope="row"><?= $i ?></th>
                  <td><?= $outlet['kode_outlet'] ?></td>
                  <td><?= $outlet['nama_outlet'] ?></td>
                  <td><?= $outlet['alamat'] ?></td>
                  <td><?= $outlet['pic'] ?></td>
                  <td class="w-[200px] flex items-center justify-center gap-1">
                     <a href="/outlet/<?= $outlet['id'] ?>" class="text-sm rounded-md px-3 py-1 bg-green-400">Update</a>
                     <form method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button data-outlet_id="<?= $outlet['id'] ?>" onclick="deleteOutlet()" class="text-sm rounded-md px-3 py-1 bg-red-400">Delete</button>
                     </form>
                  </td>
               </tr>
            <?php
               $i++;
            endforeach;
            ?>
         </tbody>
      </table>
   <?php else : ?>
      <div class="mt-10 bg-white w-full text-center text-black p-10 rounded-md">Tidak ada data untuk ditampilkan</div>
   <?php endif ?>
</div>
<?= $this->endSection(); ?>