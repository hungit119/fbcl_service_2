<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Authenticatable, HasFactory;
    const TABLE = 'images';
    const _ID = 'id';
    const _PATH = 'path';
    const _ORIGIN_NAME = 'origin_name';
    const _SIZE = 'size';
    const _TYPE = 'type';
    const _POST_ID = 'post_id';
    const _NEW_ID = 'new_id';
    const _REMARKABLE_ID = 'remarkable_id';
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
        self::_PATH,
        self::_ORIGIN_NAME,
        self::_SIZE,
        self::_TYPE,
        self::_POST_ID,
        self::_NEW_ID,
        self::_REMARKABLE_ID,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];
}
