<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model
{
    use HasFactory;

    protected $fillable = ['imageID', 'image_path'];

    public function listing() {
        return $this->belongsTo(Listing::class, 'imageID');
    }
}
