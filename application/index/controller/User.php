<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    //查看用户的信息
    public function userInfo()
    {
        $userinfo = model('User')->where('id', input('id'))->find();
        $today = date('Y-m-d');
        $day_1 = date('Y-m-d', strtotime("-1 day"));
        $day_1_0 = strtotime(date('Y-m-d 00:00:00'));
        $day_2 = date('Y-m-d', strtotime("-2 day"));
        $day_2_0 = strtotime(date('Y-m-d 00:00:00', strtotime("-1 day")));
        $day_3 = date('Y-m-d', strtotime("-3 day"));
        $day_3_0 = strtotime(date('Y-m-d 00:00:00', strtotime("-2 day")));
        $day_4 = date('Y-m-d', strtotime("-4 day"));
        $day_4_0 = strtotime(date('Y-m-d 00:00:00', strtotime("-3 day")));
        $day_5 = date('Y-m-d', strtotime("-5 day"));
        $day_5_0 = strtotime(date('Y-m-d 00:00:00', strtotime("-4 day")));
        $day_6 = date('Y-m-d', strtotime("-6 day"));
        $day_6_0 = strtotime(date('Y-m-d 00:00:00', strtotime("-5 day")));
        $day_7_0 = strtotime(date('Y-m-d 00:00:00', strtotime("-6 day")));
        $days = json_encode([$day_6, $day_5, $day_4, $day_3, $day_2, $day_1, $today]);

        $todaysubnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '>', $day_1_0)->count();
        $day_1subnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '<', $day_1_0)->where('create_time', '>', $day_2_0)->count();
        $day_2subnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '<', $day_2_0)->where('create_time', '>', $day_3_0)->count();
        $day_3subnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '<', $day_3_0)->where('create_time', '>', $day_4_0)->count();
        $day_4subnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '<', $day_4_0)->where('create_time', '>', $day_5_0)->count();
        $day_5subnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '<', $day_5_0)->where('create_time', '>', $day_6_0)->count();
        $day_6subnum = model('Quessub')->where('user_id', input('id'))->where('create_time', '<', $day_6_0)->where('create_time', '>', $day_7_0)->count();
        $usersubnum = json_encode([$day_6subnum, $day_5subnum, $day_4subnum, $day_3subnum, $day_2subnum, $day_1subnum, $todaysubnum]);
        $todayacnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '>', $day_1_0)->count();
        $day_1acnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '<', $day_1_0)->where('create_time', '>', $day_2_0)->count();
        $day_2acnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '<', $day_2_0)->where('create_time', '>', $day_3_0)->count();
        $day_3acnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '<', $day_3_0)->where('create_time', '>', $day_4_0)->count();
        $day_4acnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '<', $day_4_0)->where('create_time', '>', $day_5_0)->count();
        $day_5acnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '<', $day_5_0)->where('create_time', '>', $day_6_0)->count();
        $day_6acnum = model('Quessub')->where('user_id', input('id'))->where('judge_status', '=', '2')->where('create_time', '<', $day_6_0)->where('create_time', '>', $day_7_0)->count();
        $useracnum = json_encode([$day_6acnum, $day_5acnum, $day_4acnum, $day_3acnum, $day_2acnum, $day_1acnum, $todayacnum]);

        $quessubs = model('Quessub')->with('question')->where('user_id', session('user.id'))->order('create_time', 'desc')->limit(5)->select();
        $quessub_page = model('Quessub')->with('question')->where('user_id', input('id'))->order('create_time', 'desc')->paginate(10);


        $viewData = [
            'userinfo' => $userinfo,
            'usersubnum' => $usersubnum,
            'useracnum' => $useracnum,
            'days' => $days,
            'quessubs' => $quessubs,
            'quessub_page' => $quessub_page
        ];
        $this->assign($viewData);
        return view('userinfo');
    }

    //修改用户的基本信息
    public function userBaseEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'email' => input('post.email'),
                'qq' => input('post.qq'),
                'blog' => input('post.blog'),
                'sign' => input('post.sign'),
            ];
            $result = model('User')->baseEdit($data);
            if ($result == 1) {
                $this->success('基本信息修改成功');
            } else {
                $this->error($result);
            }
        }
        return view('userbaseedit');
    }

    //修改用户的密码
    public function userPassEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => session('user.id'),
                'oldpass' => input('post.oldpass'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass')
            ];
            $result = model('User')->passEdit($data);
            if ($result == 1) {
                $this->success('密码修改成功');
            } else {
                $this->error($result);
            }
        }
        return view('userpassedit');
    }
}
