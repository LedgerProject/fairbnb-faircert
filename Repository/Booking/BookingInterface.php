<?php

namespace Modules\Ledger\Repository\Booking;

use App\Repository\EloquentRepositoryInterface;

interface BookingInterface extends EloquentRepositoryInterface  {

    
    public function getAllBooking($array,$search);
    public function getRejectedBooking($array,$search);
    
}