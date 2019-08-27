<?php

namespace App\Observers;

use App\PackAutoComplete;
use App\Repositories\PackAutoCompleteRepository;

class PackAutoCompleteObserver
{
    /**
     * Handle the pack "created" event.
     *
     * @param  \App\PackAutoComplete  $packAutoComplete
     * @return void
     */
    public function created(PackAutoComplete $packAutoComplete)
    {
        $packAutoCompleteRepository = new PackAutoCompleteRepository ();
        $packAutoCompleteRepository->clearCache ();
    }

    /**
     * Handle the pack "updated" event.
     *
     * @param  \App\PackAutoComplete  $packAutoComplete
     * @return void
     */
    public function updated(PackAutoComplete $packAutoComplete)
    {
        $packAutoCompleteRepository = new PackAutoCompleteRepository ();
        $packAutoCompleteRepository->clearCache ();
    }

    /**
     * Handle the pack "deleted" event.
     *
     * @param  \App\PackAutoComplete  $packAutoComplete
     * @return void
     */
    public function deleted(PackAutoComplete $packAutoComplete)
    {
        $packAutoCompleteRepository = new PackAutoCompleteRepository ();
        $packAutoCompleteRepository->clearCache ();
    }

    /**
     * Handle the pack "restored" event.
     *
     * @param  \App\PackAutoComplete  $packAutoComplete
     * @return void
     */
    public function restored(PackAutoComplete $packAutoComplete)
    {
        $packAutoCompleteRepository = new PackAutoCompleteRepository ();
        $packAutoCompleteRepository->clearCache ();
    }

    /**
     * Handle the pack "force deleted" event.
     *
     * @param  \App\PackAutoComplete  $packAutoComplete
     * @return void
     */
    public function forceDeleted(PackAutoComplete $packAutoComplete)
    {
        $packAutoCompleteRepository = new PackAutoCompleteRepository ();
        $packAutoCompleteRepository->clearCache ();
    }
}
