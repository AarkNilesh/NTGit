<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'life_path', 'destiny', 'soul_urge', 'personality', 'content'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
