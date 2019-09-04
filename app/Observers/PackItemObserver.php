<?php

namespace App\Observers;

use App\PackItem;
use App\Repositories\PackItemRepository;

class PackItemObserver
{
    /**
     * Handle the pack item "created" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function created(PackItem $packItem)
    {
        $packItem = new PackItemRepository ();
        $packItem->clearCache ();
    }

    /**
     * Handle the pack item "updated" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function updated(PackItem $packItem)
    {
        $packItem = new PackItemRepository ();
        $packItem->clearCache ();
    }

    /**
     * Handle the pack item "deleted" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function deleted(PackItem $packItem)
    {
        $packItem = new PackItemRepository ();
        $packItem->clearCache ();
    }

    /**
     * Handle the pack item "restored" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function restored(PackItem $packItem)
    {
        $packItem = new PackItemRepository ();
        $packItem->clearCache ();
    }

    /**
     * Handle the pack item "force deleted" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function forceDeleted(PackItem $packItem)
    {
        $packItem = new PackItemRepository ();
        $packItem->clearCache ();
    }
}
