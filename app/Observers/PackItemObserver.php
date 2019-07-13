<?php

namespace App\Observers;

use App\PackItem;
use App\Repositories\PackRepository;

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
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack item "updated" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function updated(PackItem $packItem)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack item "deleted" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function deleted(PackItem $packItem)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack item "restored" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function restored(PackItem $packItem)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack item "force deleted" event.
     *
     * @param  \App\PackItem  $packItem
     * @return void
     */
    public function forceDeleted(PackItem $packItem)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }
}
