<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews'; 
    
    protected $fillable = ['renterID', 'rentalAgreementID', 'rate', 'comment'];


    // Define the relationship to RentalAgreement
    public function agree() {
        return $this->belongsTo(Reviews::class, 'rentalAgreementID');
    }
    public function rentalAgreement()
    {
        return $this->belongsTo(RentalAgreement::class, 'rentalAgreementID');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renterID');
    }
}
