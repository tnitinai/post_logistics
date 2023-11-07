<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    protected $table = 'PostalCode';
    protected $primaryKey = 'postal_code';
    public $timestamps = false;

    public function getPostalLocationAttribute()
    {
        return "$this->postal_code $this->district $this->province";
    }
}
