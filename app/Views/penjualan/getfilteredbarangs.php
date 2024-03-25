<?php foreach ($barangs as $barang) : ?>
   <label for="<?= 'option-' . $barang["kode_barang"] ?>" class="flex justify-between items-center p-1 text-sm">
      <input type="checkbox" name="barang" id="<?= 'option-' . $barang["kode_barang"] ?>" value="<?= $barang["kode_barang"] ?>" class="hidden peer option-barang">
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