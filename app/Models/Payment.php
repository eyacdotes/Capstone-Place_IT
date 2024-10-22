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
            User::class,  // The final model (User) you want to retrieve
            RentalAgreement::class,  // The intermediary model (RentalAgreement) between Payment and User
            'rentalAgreementID',  // Foreign key on the RentalAgreement table
            'userID',  // Foreign key on the User table
            'rentalAgreementID',  // Local key on the Payment table
            'ownerID'  // Local key on the RentalAgreement table (make sure this is correctly named)
        );
    }
    public function negotiation()
    {
        return $this->belongsTo(Negotiation::class, 'rentalAgreementID', 'listingID'); // Assuming rentalAgreementID relates to the listingID in Negotiation
    }

    public function billing() {
        return $this->hasOne(BillingDetail::class, 'rental_agreement_id', 'rentalAgreementID');
    }
    public function meetupProof()
    {
        return $this->hasOne(MeetupProof::class, 'rental_agreement_id', 'rentalAgreementID');
    }
}
