<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//
//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('/', 'index/hello');
//
//return [
//
//];

Route::rule('/', 'index/index/index', 'get');
Route::rule('problemlist', 'index/problem/problemlist', 'get');
Route::rule('register', 'index/index/register', 'get|post');
Route::rule('verify', 'index/index/verify', 'post');
Route::rule('login', 'index/index/login', 'get|post');
Route::rule('loginout', 'index/index/loginout', 'post');
Route::rule('verifyforget', 'index/index/verifyforget', 'get|post');
Route::rule('forget', 'index/index/forget', 'get|post');
Route::rule('probleminfo/[:id]', 'index/problem/probleminfo', 'get');
Route::rule('userinfo/[:id]', 'index/user/userinfo', 'get');
Route::rule('userbaseedit', 'index/user/userbaseedit', 'post');
Route::rule('userpassedit', 'index/user/userpassedit', 'post');
Route::rule('rankinglist', 'index/ranking/rankinglist', 'get');
Route::rule('submitlist', 'index/submit/submitlist', 'get');
Route::rule('problemlistkeyword', 'index/problem/problemlistkeyword', 'get');
Route::rule('problemcomment', 'index/problem/problemcomment', 'get|post');
Route::rule('problemsubmit', 'index/problem/problemsubmit', 'get|post');
Route::rule('submitadd', 'index/submit/submitadd', 'post|get');
Route::rule('questioncate', 'index/question/questioncate', 'get');
Route::rule('questioninfo/[:cate_id]', 'index/question/questioninfo', 'get|post');
Route::rule('question/[:id]', 'index/question/question', 'get|post');
Route::rule('quessub', 'index/question/quessub', 'get|post');
Route::rule('quessublist', 'index/quessub/quessublist', 'get|post');
Route::rule('questionkeyword', 'index/question/questionkeyword', 'get');

Route::group('admin', function () {
    Route::rule('/', 'admin/index/login', 'get|post');
    Route::rule('index', 'admin/home/index', 'get');
    Route::rule('loginout', 'admin/index/loginout', 'post');
    Route::rule('forget', 'admin/index/forget', 'get|post ');
    Route::rule('forgetre', 'admin/index/forgetre', 'post');
    Route::rule('register', 'admin/index/register', 'get|post');
    Route::rule('commentlist', 'admin/comment/commentlist', 'get');
    Route::rule('commentread/[:id]', 'admin/comment/commentread', 'get');
    Route::rule('commentdel', 'admin/comment/commentdel', 'post|get');
    Route::rule('userlist', 'admin/user/userlist', 'get');
    Route::rule('useradd', 'admin/user/useradd', 'post|get');
    Route::rule('userdel', 'admin/user/userdel', 'post|get');
    Route::rule('useredit/[:id]', 'admin/user/useredit', 'post|get');
    Route::rule('adminlist', 'admin/admin/adminlist', 'get');
    Route::rule('adminadd', 'admin/admin/adminadd', 'post|get');
    Route::rule('admindel', 'admin/admin/admindel', 'post');
    Route::rule('adminstatus', 'admin/admin/adminstatus', 'post');
    Route::rule('adminedit/[:id]', 'admin/admin/adminedit', 'post|get');
    Route::rule('newslist', 'admin/news/newslist', 'get');
    Route::rule('newsadd', 'admin/news/newsadd', 'post|get');
    Route::rule('newsdel', 'admin/news/newsdel', 'post');
    Route::rule('newsedit/[:id]', 'admin/news/newsedit', 'post|get');
    Route::rule('newsread/[:id]', 'admin/news/newsread', 'get');
    Route::rule('problemlist', 'admin/problem/problemlist', 'get');
    Route::rule('problemadd', 'admin/problem/problemadd', 'post|get');
    Route::rule('problemdel', 'admin/problem/problemdel', 'post');
    Route::rule('problemedit/[:id]', 'admin/problem/problemedit', 'post|get');
    Route::rule('problemread/[:id]', 'admin/problem/problemread', 'get');
    Route::rule('problemstatus', 'admin/problem/problemstatus', 'post');
    Route::rule('testdatalist', 'admin/testdata/testdatalist', 'get');
    Route::rule('testdataadd/[:id]', 'admin/testdata/testdataadd', 'post|get');
    Route::rule('testdatadel', 'admin/testdata/testdatadel', 'post');
    Route::rule('testdataedit/[:id]', 'admin/testdata/testdataedit', 'post|get');
    Route::rule('testdataread/[:id]', 'admin/testdata/testdataread', 'get|post');
    Route::rule('questionlist', 'admin/question/questionlist', 'get');
    Route::rule('questionadd', 'admin/question/questionadd', 'post|get');
    Route::rule('questiondel', 'admin/question/questiondel', 'post');
    Route::rule('questionedit/[:id]', 'admin/question/questionedit', 'post|get');
    Route::rule('questionread/[:id]', 'admin/question/questionread', 'get');
    Route::rule('questionstatus', 'admin/question/questionstatus', 'post');
    Route::rule('catelist', 'admin/cate/catelist', 'get');
    Route::rule('cateadd', 'admin/cate/cateadd', 'post|get');
    Route::rule('catedel', 'admin/cate/catedel', 'post');
    Route::rule('cateedit/[:id]', 'admin/cate/cateedit', 'post|get');
});