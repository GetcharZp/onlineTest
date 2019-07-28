<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/24
 * Time: 11:13
 */

namespace app\index\controller;


use think\Controller;

class Submit extends Controller
{
    // 提交问题的列表
    public function submitList()
    {
        $submits = model('Submit')->with('user')->order('create_time', 'desc')->paginate(6);
        $viewData = [
            'submits' => $submits
        ];
        $this->assign($viewData);
        return view('submitlist');
    }

    // 代码的提交
    public function submitAdd()
    {
        if(request()->isAjax()) {
            $data = [
                'pro_id' => input('post.pro_id'),
                'user_id' => session('user.id'),
                'language' => input('post.language'),
                'code' => input('post.code')
            ];
            $problemInfo =model('Problem')->find($data['pro_id']);
            $problemInfo->setInc('subnum');

            $data['judge_status'] = 1;
            $data['code_len'] = mb_strlen($data['code']);
            $result = model('Submit')->add($data);
            if ($result == 1) {
                $this->success('代码提交成功', 'index/submit/submitlist');
            } else {
                $this->error($result);
            }
        }
    }
}