<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationParticipant extends Model
{
    use Authenticatable, HasFactory;
    const TABLE = 'conversation_participants';
    const _CONVERSATION_ID = 'conversation_id';
    const _USER_ID = 'user_id';
    const _JOINED_AT = 'joined_at';
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
        self::_CONVERSATION_ID,
        self::_USER_ID,
        self::_JOINED_AT,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];
}
