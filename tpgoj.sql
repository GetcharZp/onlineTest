-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019-10-23 17:08:14
-- 服务器版本： 5.7.26-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpgoj`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE `tp_admin` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '管理员ID',
  `username` varchar(25) NOT NULL COMMENT '管理员的用户名',
  `password` varchar(64) NOT NULL COMMENT '管理员的密码',
  `email` varchar(25) NOT NULL COMMENT '管理员的邮箱',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0表示禁用，1表示可用管理员',
  `is_super` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0是普通管理员，1是超级管理员',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_cate`
--

CREATE TABLE `tp_cate` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '分类的ID',
  `catename` varchar(25) NOT NULL COMMENT '分类的名称',
  `parent_id` int(11) NOT NULL COMMENT '分类的父级ID',
  `admin_id` int(11) NOT NULL COMMENT '添加该分类的管理员',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_comment`
--

CREATE TABLE `tp_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '留言的ID',
  `content` text NOT NULL COMMENT '留言的内容',
  `pro_id` int(11) NOT NULL COMMENT '问题的ID',
  `user_id` int(11) NOT NULL COMMENT '发表该留言的用户',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_mainwork`
--

CREATE TABLE `tp_mainwork` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '重点工作推进ID',
  `name` varchar(32) NOT NULL COMMENT '事项的名称',
  `desc` varchar(255) DEFAULT NULL COMMENT '事项的描述',
  `unit` varchar(32) DEFAULT NULL COMMENT '责任单位',
  `person` varchar(32) DEFAULT NULL COMMENT '责任人',
  `finish_time` varchar(32) DEFAULT NULL COMMENT '完成时限',
  `status` tinyint(1) DEFAULT NULL COMMENT '推进状态，0未完成，1完成50%，2完成',
  `finish_status` varchar(255) DEFAULT NULL COMMENT '落实情况',
  `click` int(11) DEFAULT NULL COMMENT '点击量',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_news`
--

CREATE TABLE `tp_news` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'news id',
  `title` varchar(50) NOT NULL COMMENT '新闻的标题',
  `content` longtext NOT NULL COMMENT '新闻的正文',
  `admin_id` int(11) NOT NULL COMMENT '新闻的发布者',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_problem`
--

CREATE TABLE `tp_problem` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '问题ID',
  `title` varchar(50) NOT NULL COMMENT '问题的名称',
  `cate_id` int(11) DEFAULT NULL COMMENT '问题分类',
  `desc` longtext NOT NULL COMMENT '问题的描述',
  `indesc` longtext NOT NULL COMMENT '问题的输入描述',
  `outdesc` longtext NOT NULL COMMENT '问题的输出描述',
  `insample` longtext NOT NULL COMMENT '输入案例',
  `outsample` longtext NOT NULL COMMENT '输出案例',
  `hint` varchar(255) DEFAULT NULL COMMENT '问题的提示',
  `admin_id` int(11) NOT NULL COMMENT '上传问题的管理员ID',
  `memlimit` varchar(20) NOT NULL COMMENT '内存限制',
  `timelimit` varchar(20) NOT NULL COMMENT '时间限制',
  `subnum` int(11) NOT NULL DEFAULT '0' COMMENT '提交的次数',
  `acnum` int(11) NOT NULL DEFAULT '0' COMMENT '正确的个数',
  `difflavel` int(11) NOT NULL COMMENT '问题的难易程度',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '问题状态默认是未启用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_quessub`
--

CREATE TABLE `tp_quessub` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '用户的提交ID',
  `que_id` int(11) NOT NULL COMMENT '问题ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `user_ans` longtext NOT NULL COMMENT '用户提交的答案',
  `cate_id` int(11) NOT NULL COMMENT '问题类别ID',
  `judge_status` int(11) NOT NULL COMMENT '判题的状态，1：waiting，2：Accept， 3：Wrong Answer',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_question`
--

CREATE TABLE `tp_question` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '题目ID',
  `content` longtext NOT NULL COMMENT '题目的描述',
  `cate_id` int(11) NOT NULL COMMENT '问题的分类',
  `acans` longtext NOT NULL COMMENT '参考答案',
  `difflavel` int(11) NOT NULL COMMENT '问题的难度等级：1-5',
  `type` int(11) NOT NULL COMMENT '题目类型1：选择题，2：判断题，3：填空题，4：解答题，自由练题不会出现解答题选项',
  `ans_a` longtext COMMENT '选项A',
  `ans_b` longtext COMMENT '选项B',
  `ans_c` longtext COMMENT '选项C',
  `ans_d` longtext COMMENT '选项D',
  `admin_id` int(11) NOT NULL COMMENT '作者',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0表示问题未启用，1表示问题启用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_submit`
--

CREATE TABLE `tp_submit` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '用户的提交信息的ID',
  `user_id` int(11) NOT NULL COMMENT '提交该任务的用户ID',
  `pro_id` int(11) NOT NULL COMMENT '该提交对应的问题ID',
  `language` varchar(20) NOT NULL COMMENT '该提交所选择的语言1：C/C++,2:Java',
  `judge_status` varchar(255) NOT NULL COMMENT '返回的状态，\r\n1：Waiting（程序刚刚提交，在等待OJ评测你的程序）\r\n2：Compiling（代码正在后台编译）\r\n3：Running（程序运行）\r\n4：Judging（OJ正在检查您程序的输出是否正确）\r\n5：Accepted（程序正确，题目已经正确解答）\r\n6：Compilation Error（代码编译错误，可以点击查看编译错误细节）\r\n7：Runtime Error（程序运行时错误，一般是程序在运行期间执行了非法的操作造成的）\r\n8：Time Limit Exceeded（程序超过了题目的时间限制）\r\n9：Memory Limit Exceeded（程序超过了题目的内存限制\n）\r\n10：\n\nPresentation Error（程序运行的结果是正确的，格式和错误。\n\n比如中间多了回车或者空格，请仔细检查程序的输出部分，离AC就差一点点啦！）\r\n11：\n\nRestricted Function（代码中使用了不安全的函数\n）\r\n12：\nWrong Answer（程序不正确，一般认为是算法有问题\n\n）\r\n13：System Error（OJ内部出现错误）',
  `exe_time` int(11) NOT NULL COMMENT '程序的处理时间',
  `exe_memory` int(11) NOT NULL COMMENT '程序所用的内存',
  `code` longtext NOT NULL COMMENT '提交的代码',
  `code_len` int(11) NOT NULL COMMENT '代码的长度',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_testdata`
--

CREATE TABLE `tp_testdata` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '测试数据的ID',
  `pro_id` int(11) NOT NULL COMMENT '该测试数据所对应的问题ID，一个问题通常会对应多条测试数据',
  `admin_id` int(11) NOT NULL COMMENT '添加数据的作者',
  `indata` longtext NOT NULL COMMENT '测试数据的输入',
  `outdata` longtext NOT NULL COMMENT '测试数据的输出',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `tp_user`
--

CREATE TABLE `tp_user` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '用户的ID，自增长',
  `username` varchar(25) NOT NULL COMMENT '用户的名字，不能超过25位',
  `qq` varchar(25) DEFAULT NULL,
  `blog` varchar(50) DEFAULT NULL,
  `sign` longtext,
  `password` varchar(64) NOT NULL COMMENT '用户密码，6~25位',
  `email` varchar(25) NOT NULL COMMENT '用户邮箱',
  `icon` varchar(255) DEFAULT NULL COMMENT '用户的头像',
  `subnum` int(11) DEFAULT '0',
  `acnum` int(11) DEFAULT '0',
  `create_time` int(11) NOT NULL COMMENT '用户生成的时间',
  `update_time` int(11) NOT NULL COMMENT '用户修改信息后的时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '默认为空的时候表示用户存在可用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tp_admin`
--
ALTER TABLE `tp_admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_cate`
--
ALTER TABLE `tp_cate`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_comment`
--
ALTER TABLE `tp_comment`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_mainwork`
--
ALTER TABLE `tp_mainwork`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_news`
--
ALTER TABLE `tp_news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_problem`
--
ALTER TABLE `tp_problem`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_quessub`
--
ALTER TABLE `tp_quessub`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_question`
--
ALTER TABLE `tp_question`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_submit`
--
ALTER TABLE `tp_submit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_testdata`
--
ALTER TABLE `tp_testdata`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tp_user`
--
ALTER TABLE `tp_user`
  ADD PRIMARY KEY (`id`,`create_time`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tp_admin`
--
ALTER TABLE `tp_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员ID', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `tp_cate`
--
ALTER TABLE `tp_cate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类的ID', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `tp_comment`
--
ALTER TABLE `tp_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '留言的ID', AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `tp_mainwork`
--
ALTER TABLE `tp_mainwork`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '重点工作推进ID', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `tp_news`
--
ALTER TABLE `tp_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'news id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `tp_problem`
--
ALTER TABLE `tp_problem`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '问题ID', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `tp_quessub`
--
ALTER TABLE `tp_quessub`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户的提交ID', AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `tp_question`
--
ALTER TABLE `tp_question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '题目ID', AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `tp_submit`
--
ALTER TABLE `tp_submit`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户的提交信息的ID', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `tp_testdata`
--
ALTER TABLE `tp_testdata`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '测试数据的ID', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `tp_user`
--
ALTER TABLE `tp_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户的ID，自增长', AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
