<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'full_name', 'birth_date', 'phone', 'email', 'notes'];

    protected $casts = ['birth_date' => 'date'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
