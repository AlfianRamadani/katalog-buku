<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us'; // Sesuai nama tabel

    protected $fillable = ['name', 'email', 'message', 'ip_address'];
}

