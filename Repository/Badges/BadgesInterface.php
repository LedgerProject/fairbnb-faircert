<?php

namespace Modules\Ledger\Repository\Badges;

use App\Repository\EloquentRepositoryInterface;

interface BadgesInterface extends EloquentRepositoryInterface  { 
    
    public function getbadgesListing();
    public function orderingStatus($sort); 
    public function addBadges($request);
    public function delete($id);
    
}