<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model
{
    use HasFactory;

    protected $table = 'listing_images'; // The table associated with the model
    
    protected $primaryKey = 'listingImageID';

    protected $fillable = ['imageID', 'image_path'];

    public function listing() {
        return $this->belongsTo(Listing::class, 'imageID');

        
    }
}
