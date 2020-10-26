<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //操作文章

    /*载入文章*/
    public function postLoad($pid)
    {
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $db_post = DB::table("post");
        $db_data = $db_post->where("pid", $pid)->get();
        //下面的内容都是event的了应该都换成读取post对应的内容

        $portrait = DB::table('user')->where('uid',$user_id)->value('avatar');
        $db_post_img = DB::table('post_img')->where("pid", $pid);
        $post_img_adr = $db_post_img->get('post_img');
        // 因为第一张图必须class设置成active才能运行，所以单独列出来
        $first_img_adr = $db_post_img->value('post_img');
        // 从复制的post贴图列表里面把第一张图去掉
        $post_img_adr->shift();
        // 每次最多显示三张图片，不然虽然能滚动，但是下面的小圆点控制不住，所以列表剩余最多2个
        while ($post_img_adr->count()>2){
            $post_img_adr->shift();
        }
        $post_name = $db_post->value('title');
        $detail = $db_post->value('detail');
        $poster_id = $db_post->value('publisher_id');
        $tag = $db_post->value('tag');
        $date = $db_post->value('date');
        $rating = $db_post->value('rating');
        // load the "heart" icon depends on liked or not
        $fav = DB::table("favourite_list");
        $data = $fav->where("uid", $user_id)
            ->where('which_id','=',0)
            ->where('fid',$pid)
            ->get();
        if($data->count()>0){
            $data->liked=true;
        }else{
            $data->liked=false;
        }


        $result = array(
            'pid' => $pid,
            'first_img' => $first_img_adr,
            'post_img_adr' => $post_img_adr,
            'portrait'=> $portrait,
            'title' => $post_name,
            'detail' => $detail,
            'poster_id' => $poster_id,
            'tag' => $tag,
            'date' => $date,
            'rating'=>$rating,
        );

//        dd($result);
        $db_comment = DB::table('post_comment');
        $comment_detail = $db_comment->where('pid', '=', $pid)->get();
        $comment = array();

        //示展comments
        foreach ($comment_detail as $key => $value) {
            array_push($comment, $comment_detail);

            $db_user = DB::table("user");
            $user_detail = $db_user->where("uid", $value->uid)->get();
//            dd($user_detail[0]->username);
            $value->uname = $user_detail[0]->username;
            $value->avatar = $user_detail[0]->avatar;

        }
//        dd($data);
        return view('event/post_details', $result)->with(["comment_detail" => $comment_detail,'data' => $data]);
    }


    /* Below are about liking posts */

    /* Click heart Icon to like a post*/
    public function like($pid)
    {
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $post_id = $pid;
        $fav = DB::table("favourite_list");
        $ids = $fav->select('id')->where("uid", $user_id)
            ->get();
        $newID = 1;
        $idArray = array();
        foreach ($ids as $key => $value ){
            array_push($idArray,$value->id);
            // $value->id;
        }

        $fav->insert(
            [

                'uid'=> $user_id,
                'fid' => $post_id,
                'which_id' => 0,
                'punched_in' => 0
            ]
        );
        return $this->postLoad($pid);
    }

    /* Click the heart icon to unlike a post */
    public function unLike($pid)
    {
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $post_id = $pid;
        $id = 0;
        $fav = DB::table("favourite_list");
        $info = $fav->where("uid", $user_id)
            ->where('which_id','=',0)
            ->where('fid',$post_id)
            ->get();
        foreach ($info as $key => $value ){
            $id = $value->id;
        }
        //$id = $data.get_class()->id;
        //echo $data;
        $fav->where('id',$id)->delete();
        return $this->postLoad($pid);
    }
}
