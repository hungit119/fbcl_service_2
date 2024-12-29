<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeelingNew extends Model
{
    use Authenticatable, HasFactory;
    const TABLE = 'feeling_news';
    const _NEW_ID = 'new_id';
    const _USER_ID = 'user_id';
    const _FEELING = 'feeling';
    const _IS_ACTIVE = 'is_active';
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
        self::_NEW_ID,
        self::_USER_ID,
        self::_FEELING,
        self::_IS_ACTIVE,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];
}
