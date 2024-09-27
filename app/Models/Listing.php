<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $table = 'listing';
    
    // If your primary key is 'listingID' instead of 'id', specify it
    protected $primaryKey = 'listingID';

    // Ensure that 'dateCreated' and other timestamps are managed properly
    public $timestamps = true;
    const CREATED_AT = 'dateCreated';
    const created_at = 'created_at';
    const UPDATED_AT = 'updated_at';
    public function owner() 
    {
        return $this->belongsTo(User::class, 'ownerID'); // Adjust the foreign key if necessary
    }
    protected $fillable = [
        'title',
        'location',
        'description',
        'image',
        'ownerID',
        'approvedBy_userID',
        'status'
    ];
    public function images() {
        return $this->hasMany(ListingImages::class, 'imageID', 'listingID');
    }
    public function rentalAgreements()
    {
        return $this->hasMany(RentalAgreement::class, 'listingID');
    }
    public function rating() {
        return $this->hasMany(Reviews::class, 'renterID');
    }
    public function reviews()
    {
        return $this->hasManyThrough(
            Reviews::class,
            RentalAgreement::class,
            'listingID', // Foreign key on RentalAgreement table
            'rentalAgreementID', // Foreign key on Reviews table
            'listingID', // Local key on Listing table
            'rentalAgreementID' // Local key on RentalAgreement table
        );
    }
    
}
