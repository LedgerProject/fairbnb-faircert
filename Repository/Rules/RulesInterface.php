<?php

namespace Modules\Ledger\Repository\Rules;

use App\Repository\EloquentRepositoryInterface;

interface RulesInterface extends EloquentRepositoryInterface  {

    
    public function getRuleListing();
    public function orderingStatus($sort);
    
    public function addRule($request);
    public function delete($id);
    
}