<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Authenticatable, HasFactory;
    const TABLE = 'news';
    const _ID = 'id';
    const _USER_ID = 'user_id';
    const _AUDIO_PATH = 'audio_path';
    const _IMG_PATH = 'img_path';
    const _CREATED_AT = 'created_at';
    const _UPDATED_AT = 'updated_at';
    const _DELETED_AT = 'deleted_at';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::_ID,
        self::_USER_ID,
        self::_AUDIO_PATH,
        self::_IMG_PATH,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];
}
