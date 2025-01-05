<?php

namespace App\Usecases\Post;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Images\ImageRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Tags\TagRepositoryInterface;
use App\Usecases\BaseUsecase;
use Illuminate\Support\Facades\DB;

class PostUsecase extends BaseUsecase implements PostUsecaseInterface
{
    protected PostRepositoryInterface $postRepo;
    protected TagRepositoryInterface $tagsRepo;
    protected ImageRepositoryInterface $imageRepo;
    public function __construct(
        PostRepositoryInterface $postRepo,
        TagRepositoryInterface $tagsRepo,
        ImageRepositoryInterface $imageRepo
    )
    {
        $this->postRepo = $postRepo;
        $this->tagsRepo = $tagsRepo;
        $this->imageRepo = $imageRepo;
    }

    public function createPost($userID,$content,$status,$feeling,$checkin,$background,$tags,$images,$friendsView,$friendsExpect)
    {
        $newPost = [
          Post::_CONTENT => $content,
          Post::_STATUS => $status,
          Post::_BACKGROUND => $background,
          Post::_FEELING => $feeling,
          Post::_CHECKIN => $checkin,
          Post::_USER_ID => $userID,
          Post::_FRIENDS_VIEW => json_encode($friendsView),
          Post::_FRIENDS_EXPECT => json_encode($friendsExpect),
          Post::_CREATED_AT => date('Y-m-d H:i:s'),
          Post::_UPDATED_AT => date('Y-m-d H:i:s')
        ];
        DB::beginTransaction();
        try {
            $post = $this->postRepo->create($newPost);
            if (!isset($post)){
                DB::rollBack();
                return [false, "Create post failed."];
            }
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            return [false, $exception->getMessage()];
        }
        // tags
        DB::beginTransaction();
        try {
            if (!empty($tags)){
                $this->tagsRepo->insert($this->prepareDataTagsInsert($post[Post::_ID],$tags));
            }
            if (!empty($images)){
                $this->imageRepo->insert($this->prepareDataImagesInsert($post[Post::_ID],$images));
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return [false, $exception->getMessage()];
        }
        return [true, $post];
    }

    private function prepareDataTagsInsert($postID, $tags)
    {
        $dataInsert = [];
        foreach ($tags as $tag){
            $dataInsert[] = [
                Tag::_POST_ID => $postID,
                Tag::_USER_ID => $tag,
                Tag::_CREATED_AT => date('Y-m-d H:i:s'),
                Tag::_UPDATED_AT => date('Y-m-d H:i:s')
            ];
        }
        return $dataInsert;
    }

    private function prepareDataImagesInsert($id, $images)
    {
        $dataInsert = [];
        foreach ($images as $image){
            $dataInsert[] = [
                Image::_PATH => $image['path'],
                Image::_ORIGIN_NAME => $image['origin_name'],
                Image::_SIZE => $image['size'],
                Image::_TYPE => $image['type'],
                Image::_POST_ID => $id,
                Image::_CREATED_AT => date('Y-m-d H:i:s'),
                Image::_UPDATED_AT => date('Y-m-d H:i:s')
            ];
        }
        return $dataInsert;
    }

    public function getListPost ($params) {
        $post = $this->postRepo->getListByParams($params);
        return $post;
    }
}
