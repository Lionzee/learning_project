<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = ['user_id', 'display_name', 'bio', 'birth_date', 'website', 'phone_number','city','occupation'];
}
