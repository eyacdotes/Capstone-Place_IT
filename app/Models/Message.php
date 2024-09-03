<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'negotiations';
    protected $fillable = ['negotiationID', 'senderID',  'message'];
    protected $primaryKey = 'negotiationID';

    public function negotiation() {
        return $this->belongsTo(Negotiation::class, 'negotiationID');
    }
    public function sender() {
        return $this->belongsTo(User::class, 'senderID');
    }
}

