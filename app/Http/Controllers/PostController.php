<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Usecases\Post\PostUsecaseInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected Request $request;
    protected PostUsecaseInterface $postUsecase;
    public function __construct(
        Request $request,
        PostUsecaseInterface $postUsecase
    )
    {
        $this->request = $request;
        $this->postUsecase = $postUsecase;
    }

    public function createPost()
    {
        $validated = $this->validateBase($this->request, [
            'content'    => 'required',
            'status'     => 'required',
            'feeling'    => 'int',
            'checkin'    => 'string',
            'background' => 'string',
            'tags'       => 'array',
            'images'     => 'array',
            'user_id'    => 'integer|required'
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $data = [];

        $userID        = $this->request->get('user_id');
        $content       = $this->request->get('content');
        $status        = $this->request->get('status');
        $feeling       = $this->request->get('feeling');
        $checkin       = $this->request->get('checkin');
        $background    = $this->request->get('background');
        $tags          = $this->request->get('tags');
        $images        = $this->request->get('images');
        $friendsView   = $this->request->get('friends_view') ?? [];
        $friendsExpect = $this->request->get('friends_expect') ?? [];

        // check feels
        if (!in_array($status, Post::LIST_STATUS)) {
            $this->message = "status incorrect";
            $this->code    = 422;
            goto next;
        }
        // check feelings
        if (!in_array($feeling, Post::LIST_FEEL)) {
            $this->message = "feeling incorrect";
            $this->code    = 422;
            goto next;
        }

        list($checked, $data) = $this->postUsecase->createPost($userID, $content, $status, $feeling, $checkin,
            $background, $tags, $images, $friendsView, $friendsExpect);
        if (!$checked) {
            $this->message = "create post fail";
            $this->code    = 400;
            goto next;
        }
        $this->status  = "success";
        $this->message = "create post success";
        $this->code    = 200;
        next:
        return $this->responseData($data);
    }

    public function getListPost()
    {
        $validated = $this->validateBase($this->request, [
            'user_id' => 'integer|required'
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $userID  = $this->request->get('user_id');
        $perPage = $this->request->get('per_page') ?? 20;

        $params['user_id'] = $userID;
        $params['per_page'] = $perPage;
        $posts              = $this->postUsecase->getListPost($params);

        $this->message = 'get list post success';
        $this->status  = 'success';
        return $this->responseData($posts);
    }
}
