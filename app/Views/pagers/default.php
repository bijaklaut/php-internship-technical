<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
   <div class="pagination flex gap-1 [&>*]:px-2 [&>*]:min-w-7 [&>*]:min-h-7 [&>*[aria-checked=true]]:bg-sky-500 [&>*:not([aria-checked=true])]:bg-white [&>*:not([aria-checked=true])]:text-black [&>*]:rounded-md [&>*]:flex [&>*]:items-center [&>*]:justify-center">
      <?php if ($pager->hasPrevious()) : ?>
         <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
            <span aria-hidden="true"><?= lang('Pager.first') ?></span>
         </a>
         <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
            <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
         </a>

      <?php endif ?>

      <?php foreach ($pager->links() as $link) : ?>
         <a href="<?= $link['uri'] ?>" <?= $link['active'] ? 'aria-checked="true"' : '' ?>>
            <?= $link['title'] ?>
         </a>
      <?php endforeach ?>

      <?php if ($pager->hasNext()) : ?>
         <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
            <span aria-hidden="true"><?= lang('Pager.next') ?></span>
         </a>
         <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
            <span aria-hidden="true"><?= lang('Pager.last') ?></span>
         </a>
      <?php endif ?>
   </div>
</nav>