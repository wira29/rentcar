<?php

namespace App\Observers;

use App\Models\Rent;
use Faker\Provider\Uuid;

class RentObserver
{
    /**
     * Handle the Rent "created" event.
     *
     * @param  \App\Models\Rent  $rent
     * @return void
     */
    public function creating(Rent $rent)
    {
        $rent->id = Uuid::uuid();
    }

    /**
     * Handle the Rent "updated" event.
     *
     * @param  \App\Models\Rent  $rent
     * @return void
     */
    public function updated(Rent $rent)
    {
        //
    }

    /**
     * Handle the Rent "deleted" event.
     *
     * @param  \App\Models\Rent  $rent
     * @return void
     */
    public function deleted(Rent $rent)
    {
        //
    }

    /**
     * Handle the Rent "restored" event.
     *
     * @param  \App\Models\Rent  $rent
     * @return void
     */
    public function restored(Rent $rent)
    {
        //
    }

    /**
     * Handle the Rent "force deleted" event.
     *
     * @param  \App\Models\Rent  $rent
     * @return void
     */
    public function forceDeleted(Rent $rent)
    {
        //
    }
}
