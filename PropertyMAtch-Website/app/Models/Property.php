<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'property_title', 'property_status', 'property_category', 'price', 'location',
        'map_url', 'description', 'land_area', 'bedrooms', 'bathrooms',
        'floors', 'legal_docs', 'images', 'video', 'amenities'
    ];

    protected $casts = [
        'legal_docs' => 'array',
        'images' => 'array',
        'amenities' => 'array',
    ];
}
