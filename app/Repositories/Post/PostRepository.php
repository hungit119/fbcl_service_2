<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    public function getModel()
    {
        return Post::class;
    }

    public function getListByParams($params)
    {
        $query = $this->_model->whereNull(Post::_DELETED_AT);
        if (isset($params['user_id'])){
            $query = $query->where(Post::_USER_ID,$params['user_id']);
        }
        if (isset($params['per_page'])){
            return $query->paginate($params['per_page']);
        }
        return $query->get();
    }
}
