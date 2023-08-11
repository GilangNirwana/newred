<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = ['key', 'username', 'url_target','optional_url'];
    protected $table = 'key_redirects';
}
