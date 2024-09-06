<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemsResource;
use App\Http\Resources\PostResource;
use App\Models\FavouriteListsItem;
use App\Models\Post;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FavouriteUserList;
use Symfony\Component\HttpFoundation\Response;

class PostApiController extends Controller
{
    use UserTrait;

    function customCollection(Collection $collection, $additionalArgument)
{
    return $collection->map(function ($item) use ($additionalArgument) {
        // حتى يمكننا ان نبعث argument اضافية في داخل Resource
        $resource = new PostResource($item , $additionalArgument);
        $resource->additional_data = $additionalArgument;
        return $resource;
    });
}

public function allMyList()
    {
        $user = $this->userAuthJWT();

        if ($user['status'] == 'error') {
              // اذا لم يوجد يوزر اعد null
            $favoriteStatusResult = null;
            $user = null;
        } else {
            $favouriteUserLists =$user->favouriteUserLists;
            foreach ($favouriteUserLists as $favourite) {

                $data[] = [
                    'id' => $favourite->id,
                    'list_name' => $favourite->list_name,
                    'items' => ItemsResource::collection($favourite->itemsCount),
                ];
            }
            return ['data' => $data];
        }
    }
    public function allPosts()
    {
        $user = $this->userAuthJWT();
        if ($user['status'] == 'error') {
              // اذا لم يوجد يوزر اعد null
         $favoriteStatusResult = $this->customCollection(Post::all(), null);
            //$user = null;
        } else {
            $posts = Post::all();
            $favouriteThroughItemes =  $user->favouriteThroughItemes;
            $listIdName =[];
            $favoriteStatusResult = [];
            

            foreach ($posts as $post) {
                 // يمكن الحصول على الitems عن طريق ManyToMany 
                $isFavorite = $favouriteThroughItemes->where('post_id', $post->id)->first();

                //اختصار الكود في تحديد العلاقة بداخل العلاقة  
                $post->favourits;

                $favoriteStatusResult[] = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'subject' => $post->subject,
                    'list_fav' => ItemsResource::collection($post->favourits),

                ];


            }
        }
            // $posts = $this->customCollection(Post::all(), $favoriteStatus);
            //PostResource::collection(Post::paginate(10) ,false );
            return ['data' => $favoriteStatusResult];
        
    }

}