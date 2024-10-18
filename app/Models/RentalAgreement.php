<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAgreement extends Model
{
    use HasFactory;
    

    protected $table = 'rental_agreements';
    protected $primaryKey = 'rentalAgreementID';

    protected $fillable = [
    'ownerID',
    'renterID',
    'listingID',
    'rentalTerm',
    'dateCreated',
    'offerAmount',
    'dateStart',
    'dateEnd',
    'status',
    'isPaid',
    ];

    public function listing() {
        return $this->belongsTo(Listing::class, 'listingID');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'ownerID');
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'rentalAgreementID', 'rentalAgreementID');
    }
    public function renter() {
        return $this->belongsTo(User::class, 'renterID');
    }
    public function space()
    {
        return $this->belongsTo(Listing::class, 'listingID');
    }
    public function billingDetails() {
        return $this->hasMany(BillingDetail::class, 'rental_agreement_id', 'rentalAgreementID');
    }
    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class, 'negotiationID');
    }
}
