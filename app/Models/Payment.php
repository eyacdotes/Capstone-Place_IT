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
    ];
}
