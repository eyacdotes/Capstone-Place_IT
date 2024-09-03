<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    use HasFactory;

    protected $fillable = ['listingID', 'senderID', 'receiverID', 'message', 'offerAmount'];
    protected $primaryKey = 'negotiationID';

    public function listing() {
        return $this->belongsTo(Listing::class, 'listingID');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'senderID');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiverID');
    }

    // Correct relationship to the Message model
    public function replies() {
        return $this->hasMany(Negotiation::class, 'listingID', 'listingID')
            ->where('negotiationID', '<>', $this->negotiationID);  // Exclude the current negotiation itself
    }
}
