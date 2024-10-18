<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; 
    protected $primaryKey = 'paymentID';

    public $timestamps = false;
    protected $fillable = [
        'rentalAgreementID',
        'renterID',
        'amount',
        'date',
        'proof',
        'details',
        'status',
        'admin_proof',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function renter()
    {
        return $this->belongsTo(User::class, 'renterID', 'userID'); // Adjust 'userID' if your primary key is different
    }
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'rentalAgreementID', 'listingID'); // Adjust if necessary
    }
        public function rentalAgreement()
    {
        return $this->belongsTo(RentalAgreement::class, 'rentalAgreementID', 'rentalAgreementID'); // Adjust if necessary
    }
    public function spaceOwner()
    {
        return $this->hasOneThrough(
            User::class,
            Listing::class,
            'listingID', // Foreign key on the listings table
            'userID',    // Foreign key on the users table
            'rentalAgreementID', // Local key on the payments table
            'ownerID'    // Local key on the listings table
        );
    }
    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class, 'rentalAgreementID', 'listingID'); // Assuming rentalAgreementID relates to the listingID in Negotiation
    }

    public function billing() {
        return $this->hasOne(BillingDetail::class, 'rental_agreement_id', 'rentalAgreementID');
    }
}
