<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function scopeGetUserOfRole($query, $role)
    {
        return $query->where('name', $role);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
