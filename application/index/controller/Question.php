<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Question extends Controller
{
    // 查看问题的分类
    public function questionCate()
    {
        // 查该用户提交过的正确问题的ID
        $question_ids = model('Quessub')->where(['user_id' => session('user.id'), 'judge_status' => 2])->column('que_id');
        // 通过array_unique 去重
        $question_ids = array_unique($question_ids);
        // 查看所有的分类
        $cates = model('Cate')->with('question')->paginate(6);
        // 查看所有分类中用户正确的个数
        for ($i = 0; $i < count($cates); $i ++) {
            $cate_id = $cates[$i]['id'];
            $num = 0;
            foreach ($question_ids as $question_id) {
                $question = model('Question')->find($question_id);
                if ($question['cate_id'] == $cate_id) {
                    $num ++;
                }
            }
            $cates[$i]['user_acnum'] = $num;
            $cates[$i]['questionnum'] = model('Question')->where('cate_id', '=', $cate_id)->where('status', '=', '1')->count();
        }
        $viewData = [
            'cates' => $cates,
            'question_ids' => $question_ids
        ];
        $this->assign($viewData);
        return view('questioncate');
    }

    // 随机出题
    public function questionInfo()
    {
        // 查该用户提交过的问题
        $question_ids = model('Quessub')->where('user_id', session('user.id'))->column('que_id');
        // 查该用户未完成的问题
        $question = model('Question')->where(['status' => '1', 'cate_id' => input('cate_id')])->whereNotIn('id', $question_ids)->find();
        $flag = 0;
        // 如果没查到用户未完成的问题，系统将在该分类中随机抽题
        if (!$question) {
            $question_ids = model('Question')->where(['status' => '1', 'cate_id' => input('cate_id')])->column('id');
            if (!empty($question_ids)) {
                shuffle($question_ids);
                $question = model('Question')->where('id', $question_ids[0])->find();
            } else {
                $flag = 1;
            }

        }
        $commentInfo = model('Comment')->with('user')->where('pro_id', $question['id'])->order('create_time', 'desc')->paginate(3);
        $quessubs = model('Quessub')->with('question')->where('user_id', session('user.id'))->order('create_time', 'desc')->limit(5)->select();

        // 查该用户提交过的正确问题的ID
        $question_idss = model('Quessub')->where(['user_id' => session('user.id'), 'judge_status' => 2])->column('que_id');
        // 通过array_unique 去重
        $question_idss = array_unique($question_idss);
        // 查看该分类的详情
        $cates = model('Cate')->with('question')->find(input('cate_id'));
        $num = 0;
        foreach ($question_idss as $question_id) {
            $question_temp = model('Question')->find($question_id);
            if ($question_temp['cate_id'] == $cates['id']) {
                $num ++;
            }
        }
        $cates['user_acnum'] = $num;

        $viewData = [
            'question' => $question,
            'commentInfo' => $commentInfo,
            'quessubs' => $quessubs,
            'flag' => $flag,
            'cates' => $cates
        ];
        $this->assign($viewData);

        return view('questioninfo');
    }

    // 答案的提交
    public function quesSub()
    {
        if (request()->isAjax()) {
            $data = [
                'que_id' => input('post.que_id'),
                'user_id' => session('user.id'),
                'user_ans' => input('post.user_ans'),
                'cate_id' => input('post.cate_id')
            ];
            $result = model('Quessub')->quesSubmit($data);
            if ($result == 1) {
                $this->success('答案提交成功', 'index/question/questioninfo?cate_id='.$data['cate_id']);
            } else {
                $this->error($result);
            }
        }
    }

    // 查看问题
    public function question()
    {
        $flag = 0;
        $question = model('Question')->where('id', input('id'))->find();
        $commentInfo = model('Comment')->with('user')->where('pro_id', input('id'))->order('create_time', 'desc')->paginate(3);
        $quessubs = model('Quessub')->with('question')->where('user_id', session('user.id'))->order('create_time', 'desc')->limit(5)->select();
        // 查该用户提交过的正确问题的ID
        $question_ids = model('Quessub')->where(['user_id' => session('user.id'), 'judge_status' => 2])->column('que_id');
        // 通过array_unique 去重
        $question_ids = array_unique($question_ids);
        // 查看该分类的详情
        $cates = model('Cate')->with('question')->find($question['cate_id']);
        $num = 0;
        foreach ($question_ids as $question_id) {
            $question_temp = model('Question')->find($question_id);
            if ($question_temp['cate_id'] == $cates['id']) {
                $num ++;
            }
        }
        $cates['user_acnum'] = $num;
        $viewData = [
            'flag' => $flag,
            'question' => $question,
            'commentInfo' => $commentInfo,
            'quessubs' => $quessubs,
            'cates' => $cates
        ];
        $this->assign($viewData);

        return view('questioninfo');
    }

    // 通过搜索显示问题列表
    public function questionKeyword()
    {
        $flag = 0;
        if (input('keyword')) {
            $where[] = ['content', 'like', '%'.input('keyword').'%'];
            $questionInfo = model('Question')->where($where)->find();
        } else {
            $questionInfo = model('Question')->find();
        }
        if ($questionInfo == null) {
            $flag = 1;
        }
        $quessubs = model('Quessub')->with('question')->where('user_id', session('user.id'))->order('create_time', 'desc')->limit(5)->select();
        $commentInfo = model('Comment')->with('user')->where('pro_id', $questionInfo['id'])->order('create_time', 'desc')->paginate(3);
        // 查该用户提交过的正确问题的ID
        $question_ids = model('Quessub')->where(['user_id' => session('user.id'), 'judge_status' => 2])->column('que_id');
        // 通过array_unique 去重
        $question_ids = array_unique($question_ids);
        // 查看该分类的详情
        $cates = model('Cate')->with('question')->find($questionInfo['cate_id']);
        $num = 0;
        foreach ($question_ids as $question_id) {
            $question_temp = model('Question')->find($question_id);
            if ($question_temp['cate_id'] == $cates['id']) {
                $num ++;
            }
        }
        $cates['user_acnum'] = $num;
        $viewData = [
            'questionInfo' => $questionInfo,
            'commentInfo' => $commentInfo,
            'quessubs' => $quessubs,
            'flag' => $flag,
            'cates' => $cates
        ];
        $this->assign($viewData);

        return view('questionkeyword');
    }
}
