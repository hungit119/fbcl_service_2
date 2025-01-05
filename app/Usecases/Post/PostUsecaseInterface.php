<?php

namespace App\Usecases\Post;

interface PostUsecaseInterface
{
    public function createPost($userID,$content,$status,$feeling,$checkin,$background,$tags,$images,$friendsView,$friendsExpect);

    public function getListPost($params);
}
