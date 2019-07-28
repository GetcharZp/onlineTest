<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    // 显示新闻主页
    public function index()
    {
        $news = model('News')->with('admin')->order('create_time', 'desc')->limit(5)->select();
        $rankings = model('User')->order(['acnum' => 'desc', 'subnum' => 'asc', 'create_time' => 'asc'])->limit(5)->select();
        $viewData = [
            'news' => $news,
            'rankings' => $rankings
        ];
        $this->assign($viewData);
        return view();
    }

    // 用户注册
    public function register()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'email' => input('post.email'),
                'verify' => input('post.verify'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass')
            ];
            $result = model('User')->register($data);
            if ($result == 1) {
                $this->success('注册成功');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    // 用户注册发送验证码
    public function verify()
    {
        if (request()->isAjax()) {
            $data = [
                'email' => input('post.email')
            ];
            $verify = mt_rand(1000, 9999);
            session('verify', $verify);
            $result = model('User')->verify($data);
            if ($result == 1) {
                $this->success('验证码发送成功');
            } else {
                $this->error($result);
            }
        }
    }

    // 找回密码发送验证码
    public function verifyforget()
    {
        if (request()->isAjax()) {
            $data = [
                'email' => input('post.email')
            ];
            $verify = mt_rand(1000, 9999);
            session('verify', $verify);
            $result = model('User')->verifyforget($data);
            if ($result == 1) {
                $this->success('验证码发送成功');
            } else {
                $this->error($result);
            }
        }
    }

    // 用户登录
    public function login()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('User')->login($data);
            if ($result == 1) {
                $this->success('登录成功');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    // 用户退出
    public function loginout()
    {
        session('user', null);
        $this->success('退出成功', 'index/index/index');
    }

    // 忘记密码
    public function forget()
    {
        if (request()->isAjax()){
            $data = [
                'email' => input('post.email'),
                'verify' => input('post.verify'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass')
            ];
            $result = model('User')->forget($data);
            if ($result == 1) {
                $this->success('密码修改成功');
            } else {
                $this->error($result);
            }
        }
        return view();
    }
}
