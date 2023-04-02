<?php

namespace App\Observers;

use App\Models\Rental;
use Faker\Provider\Uuid;

class RentalObserver
{
    /**
     * Handle the Rental "creating" event.
     *
     * @param  \App\Models\Rental  $rental
     * @return void
     */
    public function creating(Rental $rental)
    {
        $rental->id = Uuid::uuid();
    }

    /**
     * Handle the Rental "updated" event.
     *
     * @param  \App\Models\Rental  $rental
     * @return void
     */
    public function updated(Rental $rental)
    {
        //
    }

    /**
     * Handle the Rental "deleted" event.
     *
     * @param  \App\Models\Rental  $rental
     * @return void
     */
    public function deleted(Rental $rental)
    {
        //
    }

    /**
     * Handle the Rental "restored" event.
     *
     * @param  \App\Models\Rental  $rental
     * @return void
     */
    public function restored(Rental $rental)
    {
        //
    }

    /**
     * Handle the Rental "force deleted" event.
     *
     * @param  \App\Models\Rental  $rental
     * @return void
     */
    public function forceDeleted(Rental $rental)
    {
        //
    }
}
