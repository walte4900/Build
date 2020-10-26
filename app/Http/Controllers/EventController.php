<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use function PHPUnit\Framework\isEmpty;

class EventController extends Controller
{
    /**
     * 这里面主要是和事件有关的功能，包括地图定位，活动收藏，文章收藏等
     */

    /**
     * 地图功能，我也不太清楚具体细节
     */
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

    /**
     * 地图导航
     */
    public function map_navigation($eid)
    {
        // click  navigation button  --> load eid --> return langitude, latitude
        //assume  eid is 1 --> need to verify coupon e or noncoupon e
        $db_location = DB::table('event_coupon')->where('eid', '=', $eid);
//        print_r($db_location);
        if ($db_location->value('latitude') == ''){
            $db_location = DB::table('event_noncoupon')->where('eid', '=', $eid);
        }
        $latitude = $db_location->value('latitude');
        $longitude = $db_location->value('longitude');
        $location_date = array(
            'latitude' => $latitude,
            'longitude' => $longitude
        );
//        dd($location_date);
//        print_r($location_date);
        return json_encode($location_date);

//        return view('/map/navigation', $location_date);
    }

//    public function map_jump($arg2, $arg1){
//        $latitude = $arg2;
//        $longitude = $arg1;
//        $location_date = array(
//            'latitude' => $latitude,
//            'longitude' => $longitude
//        );
//        return view('/map/navigation', $location_date);
//    }


    /*
     * 载入事件详情
     * */
    public function eventLoadDetail($eid)
    {
//        dd($eid);
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $db_event = DB::table('event')->where('eid', '=', $eid);
        $start_date = $db_event->value('start_date');
        $end_date = $db_event->value('end_date');
        $first_para = $db_event->value('first_para');
        $second_para = $db_event->value('second_para');
        $location = $db_event->value('location');
        $db_event1 = DB::table('event_img')->where('eid', '=', $eid);
        $first_img = $db_event1->value('event_img_adr');
        $event_imgs = $db_event1->get('event_img_adr');
        $rating = $db_event1->value('rate_point');
        while ($event_imgs->count()>2){
            $event_imgs->shift();
        }
        $title = $db_event1->value('event_name');

        // load the "booking" icon depends on liked or not
//        $event_id = $request->input('eid');
        $event_id = $eid;
        $fav = DB::table("favourite_list");
        $data = $fav->where("uid", $user_id)
            ->where('which_id', '=', 1)
            ->where('fid', $event_id)
            ->get();
        if ($data->count() > 0) {
            $data->booked = true;
        } else {
            $data->booked = false;
        }

        $showArray = array(
            'eid' => $eid,
            'first_img' => $first_img,
            'event_imgs' => $event_imgs,
            'rating'=>$rating,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => $title,
            'first_para' => $first_para,
            'second_para' => $second_para,
            'location' => $location,
            'event_name' => $title
        );

        $db_comment = DB::table('event_comment');
        $comment_detail = $db_comment->where('eid', '=', $eid)->get();
        $comment = array();

//        dd($comment_detail);
        //展示comments
        foreach ($comment_detail as $key => $value) {
            // what it is doing about?????
            $db = DB::table("coupon");
//            $coupon_detail = $db->where("cid", $value->cid)->get();
            array_push($comment, $comment_detail);

            $db_user = DB::table("user");
            $user_detail = $db_user->where("uid", $value->uid)->get();
//            dd($user_detail[0]->username);
            $value->uname = $user_detail[0]->username;
            $value->avatar = $user_detail[0]->avatar;
        }
//        dd($comment_detail);
        return view('event/event_details', $showArray)->with(["comment_detail" => $comment_detail, 'data' => $data]);
    }


    /* 收藏活动 */
    public function book($eid)
    {
        //echo "book";
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $event_id = 1;
        $fav = DB::table("favourite_list");
        $ids = $fav->select('id')->where("uid", $user_id)
            ->get();
//        $newID = 1;
        $idArray = array();
        foreach ($ids as $key => $value) {
            array_push($idArray, $value->id);
            // $value->id;
        }

        for ($i = 1; $i < 10000; $i++) {
            if (!in_array($i, $idArray)) {
                $newID = $i;
                //echo $i;
                break;
            }
        }
        $fav->insert(
            [
                'uid' => $user_id,
                'fid' => $event_id,
                'which_id' => 1,
                'punched_in' => 0
            ]
        );

        return $this->eventLoadDetail($eid);
    }

    /* 取消收藏 */
    public function cancel($eid)
    {
        //echo "cancel";
        if (!session('status')) {
            return redirect('/login');
        }
        $user_id = session('userid');
        $event_id = $eid;
        $id = 0;
        $fav = DB::table("favourite_list");
        $info = $fav->where("uid", $user_id)
            ->where('which_id', '=', 1)
            ->where('fid', $event_id)
            ->get();
        foreach ($info as $key => $value) {
            $id = $value->id;
        }
        //$id = $data.get_class()->id;
        //echo $data;
        $fav->where('id', $id)->delete();

        return $this->eventLoadDetail($eid);
    }


    /* Belows are about coupons */

    /* 优惠券详情 */
    public function couponLoadDetail($cid)
    {
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $couponID = $cid;
        $db_coupon = DB::table('coupon')->where('cid', $couponID);
        $cid = $db_coupon->value('cid');
        $title = $db_coupon->value('title');
        $detail = $db_coupon->value('detail');
        $expire = $db_coupon->value('expire');
        $first_img = $db_coupon->value('img');
        $imgs = $db_coupon->get('img');
        while ($imgs->count()>2){
            $imgs->shift();
        }

        // load the "booking" icon depends on liked or not
        $gain_coupon = DB::table('gain_coupon');

        $data = $gain_coupon->where("uid", $user_id)
            ->where('cid', $couponID)
            ->where('status', 0)
            ->get();
        if ($data->count() > 0) {
            $data->booked = true;
        } else {
            $data->booked = false;
        }

        $showArray = array(
            'title' => $title,
            'detail' => $detail,
            'expire' => $expire,
            'img'=>$first_img,
            'imgs'=>$imgs
        );


        return view('event/coupon_details', $showArray)->with(['data' => $data]);
    }

    /* 打卡：只有在收藏了活动，且在活动范围内，活动时间内才会显示打卡，否则只是普通页面 */
    function punch($eid)
    {

        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        $db_event = DB::table('event')->where('eid', '=', $eid);
        $start_date = $db_event->value('start_date');
        $end_date = $db_event->value('end_date');
        $first_para = $db_event->value('first_para');
        $second_para = $db_event->value('second_para');
        $location = $db_event->value('location');
        $db_event1 = DB::table('event_img')->where('eid', '=', $eid);
        $first_img = $db_event1->value('event_img_adr');
        $event_imgs = $db_event1->get('event_img_adr');
        $rating = $db_event1->value('rate_point');


        $cid = DB::table('event_coupon')->where('eid',$eid)->value('cid');
        while ($event_imgs->count()>2){
            $event_imgs->shift();
        }
        $title = $db_event1->value('event_name');

        $coupon_event = DB::table("event_coupon");
        $event_lati = $coupon_event->where('eid', $eid)->value('latitude');
        $event_longi = $coupon_event->where('eid', $eid)->value('longitude');
        $event = DB::table('event')->where('eid', $eid);
        $timestamp = time();
        $info = $event->where("eid", $eid)->get();
        $fav = DB::table("favourite_list");
        $punched = $fav->where("uid", $user_id)
            ->where('which_id', '=', 1)
            ->where('fid', $eid)
            ->value('punched_in');
        $fav = DB::table("favourite_list");
        $data = $fav->where("uid", $user_id)
            ->where('which_id', '=', 1)
            ->where('fid', $eid)
            ->get();
        if ($data->count() > 0) {
            $booked = true;
        } else {
            $booked = false;
        }
        if (!$booked) {
            return redirect()->route('event',$eid);
        }
        if ($punched == 0) {
            $info->can = true;
        } else {
            $info->can = false;

        }

        $showArray = array(
            'eid' => $eid,
            'first_img' => $first_img,
            'event_imgs' => $event_imgs,
            'rating'=>$rating,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'title' => $title,
            'first_para' => $first_para,
            'second_para' => $second_para,
            'location' => $location,
            'event_name' => $title,
            'cid'=>$cid,
            'lati'=> $event_lati,
            'longi'=> $event_longi,
            'near'=>false
        );

        $db_comment = DB::table('event_comment');
        $comment_detail = $db_comment->where('eid', '=', $eid)->get();
        //dd($comment_detail);
        $comment = array();

//        dd($comment_detail);
        //展示comments
        foreach ($comment_detail as $key => $value) {
            // what it is doing about?????
            $db = DB::table("coupon");
//            $coupon_detail = $db->where("cid", $value->cid)->get();
            array_push($comment, $comment_detail);

            $db_user = DB::table("user");
            $user_detail = $db_user->where("uid", $value->uid)->get();
//            dd($user_detail[0]->username);
            $value->uname = $user_detail[0]->username;
            $value->avatar = $user_detail[0]->avatar;
        }
        //dd($comment_detail);
        return view("event/punch", $showArray)->with(['info' => $info, 'comment_detail' => $comment_detail]);
    }



    /* 打卡领券 */
    public function punchIn($eid){
        if (!session('status')) {
            return redirect('/login');
        }

        $user_id = session('userid');
        echo substr($eid, 0, -1);
        $cid = DB::table('event_coupon')->where('eid',$eid)->value('cid');

        $gain_coupon = DB::table('gain_coupon');
        $idArray = array();
        foreach ($gain_coupon->get() as $key => $value) {
            array_push($idArray, $value->gain_coupon_id);
            // $value->id;
        }

        $fid = (int)$eid;
        $fav = DB::table("favourite_list");
        $fav->where("uid", $user_id)
            ->where("which_id", '=', 1)
            ->where('fid', '=',$fid)
            ->update(['punched_in' => 1]);

        $gain_coupon->insert(
            [
                "uid" => $user_id,
                "cid" => $cid,
                "status" => 0
            ]
        );
    }

    public function punchInGo($eid)
    {
        echo "hh".$eid;
        $this->punchIn($eid);
        $cid = DB::table('event_coupon')->where('eid',$eid)->value('cid');
        return redirect()->route('coupon',$cid);

    }

    public function punchInStay($eid)
    {
        $this->punchIn($eid);
        return $this->punch($eid);

    }

}
