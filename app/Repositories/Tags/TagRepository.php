<?php

namespace App\Repositories\Tags;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{

    public function getModel()
    {
        return Tag::class;
    }
}
