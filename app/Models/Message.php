<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Authenticatable, HasFactory;
    const TABLE = 'messages';
    const _ID = 'id';
    const _CONVERSATION_ID = 'conversation_id';
    const _SENDER_ID = 'sender_id';
    const _MESSAGE = 'message';
    const _POST_ID = 'post_id';
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
        self::_CONVERSATION_ID,
        self::_SENDER_ID,
        self::_MESSAGE,
        self::_POST_ID,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];
}
