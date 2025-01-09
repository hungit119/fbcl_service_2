<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Authenticatable, HasFactory;
    protected $table = self::TABLE;
    const TABLE = 'users';
    const _ID = 'id';
    const _PHONE = 'phone';
    const _EMAIL = 'email';
    const _FULLNAME = 'fullname';
    const _ADDRESS = 'address';
    const _EDUCATION_INFO = 'education_info';
    const _WORK_INFO = 'work_info';
    const _GENDER = 'gender';
    const _RELATIONSHIP = 'relationship';
    const _DOB = 'dob';
    const _AVATAR = 'avatar';
    const _POSTER = 'poster';
    const _PASSWORD = 'password';
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
        self::_PHONE,
        self::_EMAIL,
        self::_FULLNAME,
        self::_ADDRESS,
        self::_EDUCATION_INFO,
        self::_WORK_INFO,
        self::_GENDER,
        self::_RELATIONSHIP,
        self::_DOB,
        self::_AVATAR,
        self::_POSTER,
        self::_PASSWORD,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
