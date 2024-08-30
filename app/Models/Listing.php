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
    
    protected $fillable = [
        'title',
        'location',
        'description',
        'ownerID',
        'approvedBy_userID',
        'status'
    ];
}
