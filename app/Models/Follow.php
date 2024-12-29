<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use Authenticatable, HasFactory;
    const TABLE = 'follows';
    const _FOLLOWER_ID = 'follower_id';
    const _FOLLOWED_ID = 'followed_id';
    const _TYPE = 'type';
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
        self::_FOLLOWER_ID,
        self::_FOLLOWED_ID,
        self::_TYPE,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];
}
