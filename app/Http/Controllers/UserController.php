<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //创建新用户
    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:user,username',
            'email' => 'required|unique:user,email',
            'password' => 'required'
        ]);

        $db = DB::table('user');

        $add_id = $db->insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
        return redirect('/login')->with('success','user created');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $db = DB::table('user');

        $pws = $db->where('email', $request->input('email'))->value('password');

        $id = $db->where('email', $request->input('email'))->value('uid');
        $username = $db->where('email', $request->input('email'))->value('username');

        if($pws == $request->input('password')){
            //存用户ID，用户名，登陆状态进session
            session([
                'userid'=>$id,
                'username'=>$username,
                'status'=>TRUE
                ]);
            return redirect('/')->with('success','Successfully login in.');
        }
    }

    //拍照
    public function post_page(){
        //        need a cookie for username
        return view("home/post_page");
    }

    //post发布
    public function post(Request $request){
        if(!session('status')){
            return redirect('/login');
        }

        $user_id = session('userid');
        $detail = $request->input('detail');
        $url_list = $request->input('url_list');
        $title = $request->input('title');
        $db = DB::table('post');
        $add_id = $db->insertGetId([
            'publisher_id'=>$user_id,
            'date'=>date('Y-m-d H:i:s'),
            'detail'=>$detail,
            'title'=>$title
        ]);
        $db_2 = DB::table('post_img');
        foreach($url_list as $key=>$value){
            $img = str_replace('data:image/png;base64,', '', $value);
            $data = base64_decode($img);
            $file_name = md5(microtime(true));
            $local_path = base_path(). '\\resources\\upload\\'. $file_name. '.png';
            $url = 'http://localhost/build/resources/upload/' . $file_name . '.png';
            file_put_contents($local_path, $data);
            $db_2->insert([
                [
                    'pid'=>$add_id,
                    'post_img'=> $url
                ]
            ]);
        }
        return 0;
    }

    //个人主页显示
    public function profile(){
        if(!session('status')){
            return redirect('/login');
        }

        $user_id = session('userid');
//        dd($user_id);

        $db = DB::table("post");
        $data = $db->where('publisher_id', '=', $user_id)->get();
        $db_user = DB::table("user");
        $username = $db_user->where('uid', $user_id)->get();
        $db_follower = DB::table("follow");
        $follower = $db_follower->where('followed_uid', '=', 2)->get();
        $db_followed = DB::table("follow");
        $followed = $db_followed->where('uid', '=', $user_id)->get();
        $db_coupon = DB::table("gain_coupon");
        $gain_coupon = $db_coupon->where('uid', '=', $user_id)->where("status", 0)->get();
//        dd($user_id);
        foreach($data as $key=>$value){
            $db_img = DB::table("post_img");
            $img_url = $db_img->where('pid', $value->pid)->get();
            foreach ($img_url as $key_url=>$value_url){
                $img_url = $value_url->post_img;
            }
            $value->cover_img = $img_url;
            $value->which_id = "pid";
            $value->id = $value->pid;
        }

        $result = array(
            'data'=>$data,
            'username'=>$username[0],
            'followed'=>count($followed),
            "follower"=>count($follower),
            "coupon"=>count($gain_coupon)
        );
//        dd($data);
        return view("profile/profile_page", $result);
    }

    public function setting(){
        return view("profile/setting");
    }

    //coupon list display
    public function coupon_list(){
        $user_id = session('userid');
        $db_coupon = DB::table("gain_coupon");
        $gain_coupon = $db_coupon->where('uid', '=', $user_id)->get();
        $coupons = array();
        foreach ($gain_coupon as $key=>$value){
            if ($value->status == 0){
                $db = DB::table("coupon");
                $coupon_detail = $db->where("cid", $value->cid)->get();
                array_push($coupons, $coupon_detail);
            }
        }
//        dd($coupons);
        return view("profile/coupon_list")->with("coupons",$coupons);
    }

    // when using a coupon to remove it from interface
    public function use_coupon(Request $request){
        $user_id = session('userid');
        $coupon_id = $request->input('coupon_id');
        $db_coupon = DB::table("gain_coupon");
        $db_coupon->where("uid", $user_id)->where("cid", $coupon_id)->update(["status"=> 1]);
        return 0;
    }

    public function logout(){
        session([
            'userid'=>null,
            'username'=>null,
            'status'=>FALSE
            ]);
        return redirect('/login');
    }
}
