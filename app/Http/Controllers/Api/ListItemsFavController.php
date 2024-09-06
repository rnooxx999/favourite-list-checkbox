<?php

namespace App\Http\Controllers\Api;

use App\Models\FavouriteListsItem;
use App\Models\Post;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FavouriteUserList;
use Symfony\Component\HttpFoundation\Response;

class ListItemsFavController extends Controller
{
    use UserTrait;


    ///يجب عمل $user و Auth للكود

    /////**************************  NEw List Add  ********************** ///// */

    public function storeItem(Request $request, $listId)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
        ]);

        $list = FavouriteUserList::findOrFail($listId);

        $list->items()->create([
            'post_id' => $validatedData['post_id'],
        ]);

        return response()->json(['message' => 'Item added to list successfully']);
    }

    public function newListUser(Request $request)
    {

        $listName = $request->input('list_name');

        $user = $this->userAuthJWT();
        if ($user['status'] == 'error') {
            return response()->json($user);
        } else {
            //  لو تكرر اسم القائمة
            if (!is_null($user->favouriteUserLists) && $user->favouriteUserLists->contains('list_name', $listName)) {

                if ($user->favouriteUserLists->contains('list_name', $listName)) {
                    return response()->json([
                        "status" => 'error',
                        "message" => 'تملك لستة نفس الاسم',
                        "response" => 401
                    ]);
                }
            }
            $list = FavouriteUserList::create([
                'user_id' => auth()->user()->id,
                'list_name' => $listName,
            ]);
            return response()->json([
                "status" => 'success',
                'message' => 'ادرجت قائمة جديدة بنجاح',
                "data" => $user->favouriteUserLists()->pluck('list_name'),
            ]);
        }
    }



        /////**************************  Edit List  ********************** ///// */

    public function editListUser(Request $request, $id)
    {
        $listName = $request->input('list_name');

        $user = $this->userAuthJWT();
        // return response()->json(
        //     $user['status']);
        if ($user['status'] === 'error') {

            return response()->json($user);
        } else {

            $myList = $user->favouriteUserLists->find($id);
            if (!is_null($myList)) {

                //  لو تكرر اسم القائمة
                if (!is_null($user->favouriteUserLists) && $user->favouriteUserLists->contains('list_name', $listName)) {
                    return response()->json([
                        "status" => 'error',
                        "message" => 'تملك لستة نفس الاسم',
                        "response" => 401
                    ]);
                }

                $myList->list_name = $listName;
                $myList->update();
                return response()->json([
                    "status" => 'success',
                    'message' => 'تم التحديث بنجاح',
                    "data" => $user->favouriteUserLists()->pluck('list_name'),
                ]);

            } else {
                return response()->json([
                    "status" => 'error',
                    'message' => 'مشكلة في القائمة',
                    "data" => $user->favouriteUserLists()->pluck('id'),
                ]);
            }


        }
    }


        /////**************************  items To List  ********************** ///// */
  
  

public function addItemArrayToListUser(Request $request)
{

    $postId = $request->input('post_id');
    $listIds = $request->input('list_id', []);

 $user = $this->userAuthJWT();
    if ($user['status'] === 'error') {
        return response()->json($user);
    }
    // الحصول على جميع IDs من favouriteUserLists
    $favouriteListIds = $user->favouriteUserLists()->pluck('id')->toArray();

    // تخزين نتائج الإضافة في مصفوفة
    $results = [];

 foreach ($favouriteListIds as $listId) {
        // تحقق إذا كان listId موجود في listIds
        if (in_array($listId, $listIds)) {
            // إذا وجد، فقم بإضافة العنصر إذا لم يكن موجودًا
            $item = FavouriteListsItem::firstOrCreate([
                'post_id' => $postId,
                'list_id' => $listId
            ]);
            $results[] = ['list_id' => $listId, 'status' => 'success', 'message' => 'تم تحديث العنصر', 'data' => $item];
        } else {
            // إذا لم يوجد، قم بحذف العنصر
            FavouriteListsItem::where('list_id', $listId)->where('post_id', $postId)->delete();
            $results[] = ['list_id' => $listId, 'status' => 'success', 'message' => 'تم حذف العنصر'];
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'تمت معالجة الطلب',
        'data' => $results
    ]);
}





        //     public function addItemToListUser(Request $request)
    // {
    //     // $lang = $request->input('lang');       
    //     $postId = $request->input('post_id');
    //     $listId = $request->input('list_id');

    //     $user = $this->userAuthJWT();
    //     // return response()->json(
    //     //     $user['status']);
    //     if ($user['status'] === 'error') {

    //         return response()->json($user);

    //     } else {

    //         $list = $user->favouriteUserLists()->where('id', $listId)->first();
    //         // التحقق من وجود القائمة
    //         if (!$list) {
    //             return response()->json(['message' => 'اللستة غير موجودة'], 404);
    //         }
    //         $item = FavouriteListsItem::where('list_id', $listId)->where('post_id', $postId)->first();
    //         if ($item) {
    //             // العنصر موجود، قم بحذفه
    //             $item->delete();
    //             $message = 'تم حذف العنصر';
    //             // إرجاع الاستجابة
    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => $message,
    //                 'data' => [
                        
    //                  ]
    //             ]);
    //         } else {
    //             // العنصر غير موجود، قم بإضافته
    //             $item = FavouriteListsItem::create([
    //                 'post_id' => $postId
    //                 ,
    //                 'list_id' => $listId
    //             ]);
    //             // إرجاع الاستجابة
    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'تم اضافة العنصر بنجاح',
    //                 'data' => [
    //                     'id' => $item->id,
    //                     'list_id' => $item->list_id,
    //                     'post_id' => new PostResource(Post::find($item->post_id), $user)
    //                 ]
    //             ]);

    //         }
    //     }

    // }








     /////**************************  Delete List  ********************** ///// */

    public function deleteTheList(Request $request)
    {
        $listId = $request->input('list_id');

        $user = $this->userAuthJWT();
        if ($user['status'] === 'error') {

            return response()->json($user);

        } else {
            $list = $user->favouriteUserLists()->where('id', $listId)->first();

                // التحقق من وجود القائمة
             if (!$list) {
                 return response()->json([
                    'status' => 'error',
                    'data' => [],
                    'message' => 'اللستة غير موجودة'], 404);
              }

            $list->delete();
                   

            return response()->json([
                'status' => 'success',
                'message' => 'تم حذف اللستة',
                'data' => []
            ]);

        }
        

    }

}