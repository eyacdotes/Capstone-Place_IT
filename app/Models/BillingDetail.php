<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;

    protected $table = 'billing_details'; // The table associated with the model
    
    protected $primaryKey = 'billingDetailID'; // The primary key of the table
    public $timestamps = true;
    protected $fillable = [
        'user_id', 
        'rental_agreement_id', 
        'gcash_number'
    ];
    public function rentalAgreement()
    {
        return $this->belongsTo(RentalAgreement::class, 'rental_agreement_id');
    }
}
