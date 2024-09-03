<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'payment'; // The table associated with the model
    
    protected $primaryKey = 'paymentID'; // The primary key of the table

    protected $fillable = [
        'amount',
        'date',
    ];

    // Relationship with the User model
    public function renter()
    {
        return $this->belongsTo(User::class, 'renterID'); // Adjust 'renterID' if this is your foreign key
    }
}
