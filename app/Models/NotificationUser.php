<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['email'];
    
    public function notificationSettings(){
        return $this->hasMany(NotificationSetting::class);
    }
}
