<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKycDoc extends Model
{
    use HasFactory;

    protected $fillable = ['document_type', 'image_path', 'document_name', 'size', 'verified_at', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
