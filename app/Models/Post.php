<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Authenticatable, HasFactory;

    const TABLE       = 'posts';
    const _ID         = 'id';
    const _CONTENT    = 'content';
    const _STATUS     = 'status';
    const _BACKGROUND = 'background';
    const _USER_ID    = 'user_id';
    const _FEELING    = 'feeling';
    const _CHECKIN    = 'checkin';
    const _FRIENDS_VIEW = 'friends_view';
    const _FRIENDS_EXPECT = 'friends_expect';
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
        self::_CONTENT,
        self::_STATUS,
        self::_BACKGROUND,
        self::_USER_ID,
        self::_FEELING,
        self::_CHECKIN,
        self::_FRIENDS_VIEW,
        self::_FRIENDS_EXPECT,
        self::_CREATED_AT,
        self::_UPDATED_AT,
        self::_DELETED_AT,
    ];

    const FEELING_HAPPY      = 0;          // Hạnh phúc
    const FEELING_LOVED      = 1;          // Được yêu
    const FEELING_LOVELY     = 2;         // Đáng yêu
    const FEELING_EXCITED    = 3;        // Hào hứng
    const FEELING_FUNNY      = 4;          // Điên
    const FEELING_JOYFUL     = 5;         // Sung sướng
    const FEELING_STRUGGLING = 6;     // Khổ cực
    const FEELING_LUCKY      = 7;          // Có phúc
    const FEELING_SAD        = 8;            // Buồn
    const FEELING_GRATEFUL   = 9;       // Biết ơn
    const FEELING_ADORABLE   = 10;      // Đáng yêu (lặp)
    const FEELING_TOUCHED    = 11;       // Cảm kích
    const FEELING_AWESOME    = 12;       // Tuyệt vời
    const FEELING_CHEERFUL   = 13;      // Vui vẻ

    const FEELING_NOSTALGIC      = 14;     // Hoài niệm
    const FEELING_SICK           = 15;          // Ốm yếu
    const FEELING_EXHAUSTED      = 16;     // Kiệt sức
    const FEELING_CONFIDENT      = 17;     // Tự tin
    const FEELING_FRESH          = 18;         // Tươi mới
    const FEELING_HAPPY_AGAIN    = 19;   // Hạnh phúc (lặp)
    const FEELING_CHEERFUL_AGAIN = 20; // Vui vẻ (lặp)
    const FEELING_ANGRY          = 21;         // Giận dữ
    const FEELING_SATISFIED      = 22;     // Hài lòng
    const FEELING_EMOTIONAL      = 23;     // Xúc động
    const FEELING_GREAT          = 24;         // Rất tuyệt
    const FEELING_DETERMINED     = 25;    // Quyết đoán
    const FEELING_ANNOYED        = 26;       // Bực mình
    const FEELING_LUCKY_AGAIN    = 27;   // Có phúc (lặp)
    const FEELING_WONDERFUL      = 28;     // Tuyệt vời
    const FEELING_INTERESTED     = 29;    // Thú vị
    const FEELING_POSITIVE       = 30;      // Tích cực
    const FEELING_HOPEFUL        = 31;       // Đầy hy vọng
    const FEELING_TIRED          = 32;         // Mệt mỏi
    const FEELING_PROUD          = 33;         // Tự hào
    const FEELING_THOUGHTFUL     = 34;    // Chu đáo
    const FEELING_COOL           = 35;          // Tuyệt
    const FEELING_RELAXED        = 36;       // Thư giãn
    const FEELING_COMFORTABLE    = 37;   // Thoải mái
    const FEELING_JOYFUL_AGAIN   = 38;  // Sung sướng (lặp)
    const FEELING_MOTIVATED      = 39;     // Có động lực
    const FEELING_LONELY         = 40;        // Cô đơn
    const FEELING_OK             = 41;            // OK

    const LIST_FEEL = [
        self::FEELING_HAPPY,
        self::FEELING_LOVED,
        self::FEELING_LOVELY,
        self::FEELING_EXCITED,
        self::FEELING_FUNNY,
        self::FEELING_JOYFUL,
        self::FEELING_STRUGGLING,
        self::FEELING_LUCKY,
        self::FEELING_SAD,
        self::FEELING_GRATEFUL,
        self::FEELING_ADORABLE,
        self::FEELING_TOUCHED,
        self::FEELING_AWESOME,
        self::FEELING_CHEERFUL,
        self::FEELING_NOSTALGIC,
        self::FEELING_SICK,
        self::FEELING_EXHAUSTED,
        self::FEELING_CONFIDENT,
        self::FEELING_FRESH,
        self::FEELING_HAPPY_AGAIN,
        self::FEELING_CHEERFUL_AGAIN,
        self::FEELING_ANGRY,
        self::FEELING_SATISFIED,
        self::FEELING_EMOTIONAL,
        self::FEELING_GREAT,
        self::FEELING_DETERMINED,
        self::FEELING_ANNOYED,
        self::FEELING_LUCKY_AGAIN,
        self::FEELING_WONDERFUL,
        self::FEELING_INTERESTED,
        self::FEELING_POSITIVE,
        self::FEELING_HOPEFUL,
        self::FEELING_TIRED,
        self::FEELING_PROUD,
        self::FEELING_THOUGHTFUL,
        self::FEELING_COOL,
        self::FEELING_RELAXED,
        self::FEELING_COMFORTABLE,
        self::FEELING_JOYFUL_AGAIN,
        self::FEELING_MOTIVATED,
        self::FEELING_LONELY,
        self::FEELING_OK,
    ];
    const STATUS_PUBLIC = 0;
    const STATUS_FRIENDS = 1;
    const STATUS_ONLY_ME = 2;
    const STATUS_FRIEND_SPECIFIC = 3;
    const STATUS_FRIEND_EXPECT = 4;
    const LIST_STATUS = [
        self::STATUS_PUBLIC,
        self::STATUS_FRIENDS,
        self::STATUS_ONLY_ME,
        self::STATUS_FRIEND_SPECIFIC,
        self::STATUS_FRIEND_EXPECT
    ];
}
