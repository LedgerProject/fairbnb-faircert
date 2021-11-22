<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');
    Route::group(['prefix' => 'ledger','middleware' => ['auth']],function(){
    Route::get('/', 'ListingController@index')->name('/');
    Route::get('/dashboard', 'LedgerController@index')->name('ledger.dashboard');
	
    Route::get('/listing', 'ListingController@index')->name('ledger.listing');
    Route::get('/listing/{slug}', 'ListingController@listingBySlug')->name('ledger.listdetail');
    Route::get('/listing-availabilities/{listingId}/{startDate}/{endDate}', 'ListingController@listingAvailabilities')->name('ledger.listing-availabilities');
	
    Route::get('/host-listing', 'LedgerController@hostList')->name('ledger.hostlisting');
    Route::get('/host-ajax-listing', 'LedgerController@hostListAjax')->name('ledger.host.ajax.listing');
    Route::get('/host-listing/{id}', 'LedgerController@hostDetails')->name('ledger.hostDetails');    
    Route::get('/get-ambassador-listing', 'ListingController@getListing')->name('ledger.ambassadorlisting');
    Route::get('/booking-listing', 'BookingController@index')->name('ledger.booking.index');
    Route::get('/ajax-booking-list', 'BookingController@getBookingList')->name('ledger.booking.list');
    Route::get('/rejected-booking-list', 'BookingController@rejectedBookingList')->name('ledger.booking.rejected.list');    
    Route::get('/rule-listing', 'RulesController@index')->name('ledger.rules.index');
    Route::post('/add-rule', 'RulesController@add')->name('ledger.rules.add');
    Route::get('/get-rule', 'RulesController@get')->name('ledger.rules.get');
    Route::get('/get-rule-ordering', 'RulesController@getRuleOrdering')->name('ledger.rules.ordering');
    Route::get('/delete-rule', 'RulesController@delete')->name('ledger.rules.delete');
    Route::get('/ledger-ajax-listing', 'ListingController@ledgerListAjax')->name('ledger.ajax.listing');
    Route::post('/certify-listing','ListingController@certifyListing')->name('ledger.listing.certify');
    Route::post('/email-ask-moreinfo','ListingController@askMoreInfo')->name('ledger.listing.ask.moreinfo');
    Route::get('/profile','LedgerController@profile')->name('ledger.profile');
    Route::get('/badges-listing', 'BadgesController@index')->name('ledger.badges.index');
    Route::post('/add-Badges', 'BadgesController@add')->name('ledger.Badges.add');
    Route::get('/get-badges', 'BadgesController@get')->name('ledger.badges.get');
    Route::get('/badges-listing', 'BadgesController@index')->name('ledger.badges.index');
    Route::get('/delete-badges', 'BadgesController@delete')->name('ledger.badges.delete');
    Route::post('/assign-badges', 'ListingController@assignBadges')->name('ledger.assignBadges');
    Route::get('/profile-setting','LedgerController@profileSetting')->name('ledger.profile.setting');
 
    
    Route::get('/profile-setting','LedgerController@profileSetting')->name('ledger.profile.setting');
    Route::post('/save-answers', 'LedgerController@checkAnswers')->name('ledger.keypair.answers');
    Route::post('/save-public-key', 'LedgerController@savePublicKey')->name('ledger.save.publickey');
});

Route::get('/listing/{slug}', 'FrontendController@frontendListingBySlug')->name('frontend.listing');
   
Route::get('/listing-availabilities/{listingId}/{startDate}/{endDate}', 'ListingController@listingAvailabilities')->name('ledger.listing-availabilitie');
Route::get('/listing/{slug}', 'FrontendController@frontendListingBySlug')->name('frontend.listing');
