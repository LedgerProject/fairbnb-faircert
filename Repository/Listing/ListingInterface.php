<?php
namespace Modules\Ledger\Repository\Listing;

use App\Repository\EloquentRepositoryInterface;

interface ListingInterface extends EloquentRepositoryInterface  
{
    public function getAllListingByAmbassador($certified,$search, $where);
    public function getHostListing($search);
    public function getHostDetails($slug);
    public function getRules(); 
    public function getAllBadges();  
    public function insertAssignBadges($request); 
    public function getAssignbadges($id); 
    public function certifyListing($request);
    public function listingUpgradesReview($id);
    public function listingCalendar($slug);
    public function findAvailabilitiesByListing($listingId, $start, $end);
    public function listingLocation($id);
    public function getListing($id);
    public function getFeeAsAsker();
}
