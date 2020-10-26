<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class MainController extends Controller
{
    public function login(){
        return view('user/login');
    }

    public function logon(){
        return view('user/logon');
    }

    //加载post
    public function index(){
        $db_event = DB::table("event");
        $db_event_pid = $db_event->select("eid")->get();
        $data2 = array();
        foreach($db_event_pid as $id_key=>$id_value){
            $db_event1 = DB::table("event");
            $data_part_event = $db_event1->where('eid', $id_value->eid)->get();
            foreach($data_part_event as $key=>$value){
                $db_img = DB::table("event_img");
                $img_url = $db_img->where('eid', $value->eid)->limit(1)->get();
                $value->cover_img = $img_url[0]->event_img_adr;
                $value->detail = $value->first_para;
                $value->which_id= "eid";
                $value->id = $value->eid;
            }
            if (count($data_part_event) != 0){
                array_push($data2, $data_part_event);
            }
        }

        $db_post = DB::table('post');
        $db_post_pid = $db_post->select("pid")->get();
        $data1 = array();
        foreach($db_post_pid as $id_key=>$id_value){
            $db_post1 = DB::table('post');
            $data_part = $db_post1->where('pid', $id_value->pid)->get();
            foreach($data_part as $value){
                $db_img = DB::table("post_img");
                $img_url = $db_img->where('pid', $value->pid)->limit(1)->get();
                foreach ($img_url as $key_url=>$value_url){
                    $img_url = $value_url->post_img;
                }
                $value->cover_img = $img_url;
                $value->which_id = "pid";
                $value->id = $value->pid;
            }
            if (count($data_part) != 0){
                array_push($data1, $data_part);
            }
        }
        $data["post"] = $data1;
        $data["event"] = $data2;
//        dd($data);
        return view('home.homepage')->with('data',$data);
    }

    public function select_by(Request $request){
        $option = $request->input('select_by');
        $data = null;
        if ($option == "Publishers"){
            $db_post = DB::table('post');
            $db_post_pid = $db_post->select("pid")->get();
            $data1 = array();
            foreach($db_post_pid as $id_key=>$id_value){
                $db_post1 = DB::table('post');
                $data_part = $db_post1->where('pid', $id_value->pid)->get();
                foreach($data_part as $value){
                    $db_img = DB::table("post_img");
                    $img_url = $db_img->where('pid', $value->pid)->limit(1)->get();
                    foreach ($img_url as $key_url=>$value_url){
                        $img_url = $value_url->post_img;
                    }
                    $value->cover_img = $img_url;
                    $value->which_id = "pid";
                    $value->id = $value->pid;
                }
                if (count($data_part) != 0){
                    array_push($data1, $data_part);
                }
            }
            $data = $data1;

        }elseif ($option == "Events"){
            $db_event = DB::table("event");
            $db_event_pid = $db_event->select("eid")->get();
            $data2 = array();
            foreach($db_event_pid as $id_key=>$id_value){
                $db_event1 = DB::table("event");
                $data_part_event = $db_event1->where('eid', $id_value->eid)->get();
                foreach($data_part_event as $key=>$value){
                    $db_img = DB::table("event_img");
                    $img_url = $db_img->where('eid', $value->eid)->limit(1)->get();
                    $value->cover_img = $img_url[0]->event_img_adr;
                    $value->detail = $value->first_para;
                    $value->which_id= "eid";
                    $value->id = $value->eid;
                }
                if (count($data_part_event) != 0){
                    array_push($data2, $data_part_event);
                }
            }
            $data = $data2;
        }
//        dd($data);
        return json_encode($data);
    }

    public function mapinit()
    {
        //加载map里的数据到map里面
//        $db_coupon = DB::table('event_coupon');
//        $db_nonCoupon = DB::table('event_noncoupon');
//        $coupon_data = $db_coupon->get()->map(function ($value) {return (array)$value;})->toArray();
//
//        $nonCoupon_data = $db_nonCoupon->get()->map(function ($value) {return (array)$value;})->toArray();
//        echo $coupon_data;
//        echo $nonCoupon_data;

        $db_coupon = DB::table('event_coupon')->get();
        $coupon_data = array();
        $db_nonCoupon = DB::table('event_noncoupon')->get();
        $nonCoupon_data = array();
        //load event in map

        foreach ($db_coupon as $key => $value) {
            array_push($coupon_data, $db_coupon);
        }

        foreach ($db_nonCoupon as $key => $value) {
            array_push($nonCoupon_data, $db_nonCoupon);
        }
//        return view('map/mapshow')->with(['coupon_data' => $coupon_data, 'nonCoupon_data' => $nonCoupon_data]);

        return view('map/mapshow')->with(['db_nonCoupon' => $db_nonCoupon, 'db_coupon' => $db_coupon]);
    }

    public function map_jump($arg2, $arg1){
        $latitude = $arg2;
        $longitude = $arg1;
        $location_date = array(
            'latitude' => $latitude,
            'longitude' => $longitude
        );
        return view('/map/navigation', $location_date);
    }

    public function favourite(){
        if(!session('status')){
            return redirect('/login');
        }

        $user_id = session('userid');
        $db = DB::table("favourite_list");
        $data = $db->where("uid", $user_id)->get();
        $data1 = null;
        foreach($data as $key=>$value){
            $data_append = null;
            if ($value->which_id == 1){
                //load event
                $db = DB::table("event");
                // The eid is fid
                $data_append = $db->where("eid", $value->fid)->orderBy('start_date', 'desc')->get();
                // The second key-value pair
                foreach($data_append as $key2=>$value2){
                    $db_img = DB::table("event_img");
                    // Get img url
                    $img_url = $db_img->where('eid', $value2->eid)->limit(1)->get();
                    $value2->cover_img = $img_url[0]->event_img_adr;
                    $value2->type = "eid";
                    $value2->id = $value2->eid;
                    $timestamp = time();
                    if ($value2->start_date == date('Y-m-d', $timestamp)){
                        $value2->today = "yes";
                    }else{
                        $value2->today = "no";
                    }
                }
            }elseif ($value->which_id == 0){  // post
                $db = DB::table("post");
                $data_append = $db->where("pid", $value->fid)->get();
                foreach($data_append as $key1=>$value1){
                    $db_img = DB::table("post_img");
                    $img_url = $db_img->where('pid', $value1->pid)->limit(1)->get();
                    $value1->cover_img = $img_url[0]->post_img;
                    $value1->type = "pid";
                    $value1->today = "no";
                    $value1->id = $value1->pid;
                }
            }
            $data1 = $data_append->merge($data1);
        }
        return view('home.favourite')->with('data',$data1);
    }

    public function Exeventload()
    {
        $db_event = DB::table('event_img');
        $event_img_adr = $db_event->value('event_img_adr');
        $event_name = $db_event->value('event_name');
        $event_description = $db_event->value('event_description');
        $event_description2 = $db_event->value('event_description2');
        $event_rating = $db_event->value('event_rating');
        $poster_email = $db_event->value('poster_email');
        $rate_point = $db_event->value('rate_point');
        $tag = $db_event->value('tag');

        $result = array(
            'event_img_adr' => $event_img_adr,
            'event_name' => $event_name,
            'event_description' => $event_description,
            'event_rating' => $event_rating,
            'poster_email' => $poster_email,
            'tag' => $tag,
            'rate_point' => $rate_point,
            'event_description2' => $event_description2,
        );

        $db_comment = DB::table('event_comment');
        $comment_detail = $db_comment->where('eid', '=', 1)->get();
        $comment = array();
        //展示comments
        foreach ($comment_detail as $key => $value) {
            $db = DB::table("coupon");
//            $coupon_detail = $db->where("cid", $value->cid)->get();
            array_push($comment, $comment_detail);
        }
        return view('event/experienceEvent', $result)->with(["comment_detail" => $comment_detail]);
    }


    public function ExeventloadDetail()
    {
        $db_event = DB::table('event')->where('eid', '=', 1);
        $start_date = $db_event->value('start_date');
        $end_date = $db_event->value('end_date');
        $first_para = $db_event->value('first_para');
        $second_para = $db_event->value('second_para');
        $location = $db_event->value('location');
        $db_event1 = DB::table('event_img')->where('eid', '=', 1);
        $title = $db_event1->value('event_name');
        $showArray = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => $title,
            'first_para' => $first_para,
            'second_para' => $second_para,
            'location' => $location,
            'event_name' => $title
        );

        $db_comment = DB::table('event_comment');
        $comment_detail = $db_comment->where('eid', '=', 1)->get();
        $comment = array();

        //展示comments
        foreach ($comment_detail as $key => $value) {
            $db = DB::table("coupon");
//            $coupon_detail = $db->where("cid", $value->cid)->get();
            array_push($comment, $comment_detail);
        }
        return view('event/exEventDetail', $showArray)->with(["comment_detail" => $comment_detail]);
    }


    //存储booked event到数据库里
    public function store_booked()
    {
        //需要把之前uid 和 epi 传过来
        $db_booked = DB::table('event_booked');
        $add_id = $db_booked->insertGetId(
            ['eid' => 1,
                'uid' => 2
            ]);
    }


    //save comment
    public function comment_store(Request $request)
    {

        //需要加一组用户信息
        if(!session('status')){
            return redirect('/login');
        }

        $user_id = session('userid');
        $rate = $request->input('rate');
        $comment_content = $request->input('comment_content');
        $which_id = $request->input('which_id');
        $id = $request->input('id');

        $db_user = DB::table("user");
        $user_detail = $db_user->where("uid", $user_id)->get();
        $data = array(
            "username"=>$user_detail[0]->username,
            "avatar"=>$user_detail[0]->avatar,
            "comment"=>$comment_content,
            "rate"=>$rate
        );

        if ($which_id == "e"){  //eventdetail page
            $db_comment = DB::table('event_comment');
            $db_comment->insert(
                [
                    'uid' => $user_id,
                    'eid' => $id,
                    'comment' => $comment_content,
                    'rate' => $rate,
                    'uname'=>$user_detail[0]->username
                ]);

        }else{        // postdetail page
            $db_comment = DB::table('post_comment');
            $db_comment->insert(
                [
                    'uid' => $user_id,
                    'pid' => $id,
                    'comment' => $comment_content,
                    'rating' => $rate,
                    'uname'=>$user_detail[0]->username
                ]);
        }

        return $data;
    }
}
