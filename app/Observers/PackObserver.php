<?php

namespace App\Observers;

use App\Pack;
use App\Repositories\PackRepository;

class PackObserver
{
    /**
     * Handle the pack "created" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function created(Pack $pack)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack "updated" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function updated(Pack $pack)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack "deleted" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function deleted(Pack $pack)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack "restored" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function restored(Pack $pack)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }

    /**
     * Handle the pack "force deleted" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function forceDeleted(Pack $pack)
    {
        $packRepository = new PackRepository ();
        $packRepository->clearCache ();
    }
}
