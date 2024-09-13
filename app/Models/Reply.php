<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table = 'replies';
    
    protected $primaryKey = 'id';
    protected $fillable = ['negotiationID', 'senderID', 'message', 'image_chat'];

    public function negotiation() {
        return $this->belongsTo(Negotiation::class, 'negotiationID');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'senderID');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiverID');
    }
}
