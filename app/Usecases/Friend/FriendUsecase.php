<?php

namespace App\Usecases\Friend;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Images\ImageRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Tags\TagRepositoryInterface;
use App\Usecases\BaseUsecase;
use Illuminate\Support\Facades\DB;

class FriendUsecase extends BaseUsecase implements FriendUsecaseInterface
{
    public function __construct(

    )
    {

    }
}
