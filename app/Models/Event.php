<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id',
        'image'
    ];

    public function types() {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
