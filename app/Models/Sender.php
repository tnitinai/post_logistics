<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;

    protected $table = 'Sender';
    protected $primaryKey = 'citizen_id';
    public $timestamps = false;

    public function getFullNameAttribute()
    {
        if (is_null($this->lname)) {
            return "{$this->fname}";
        }

        return "{$this->fname} {$this->lname}";
    }
}
