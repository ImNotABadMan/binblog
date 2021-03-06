<?php

 namespace home\controller;
 use \core\Controller;

 class IndexController extends Controller{

    public function __construct(){
        parent::__construct();

        $navs = M("\\model\\CCateModel")->getRows('*', 'bl_cate_category', "parent_id = 0");

        $this->assign("navs", $navs);
    }

 	public function showList(){
        if(isset($_REQUEST['province']) || isset($_REQUEST['city'])){
            $province = isset($_REQUEST['province']) ? trim($_REQUEST['province']): '广东';
            $city = isset($_REQUEST['city']) ? trim($_REQUEST['city']): '';
            // var_dump($province, $city);
            //没有城市，就从数据库中找到省的第一个城市
            if($city == ''){
                $province = M('\\model\\CateModel')->getRow('*', 'bl_category', "name = '{$province}'");
                $city = M("\\model\\CateModel")->getRow('*', 'bl_category', "parent_id = {$province['id']}");
            }else{
                $city = M('\\model\\CateModel')->getRow('*', 'bl_category', "name = '{$city}'");
                $province = M("\\model\\CateModel")->getRow('*', 'bl_category', "id = {$city['parent_id']}");
            }
            //设置定位之后的城市cookie和请求的cookie

            setcookie('province', $province['name'], time() + 3600, '/');
            setcookie('city', $city['name'], time() + 3600, '/');

            setcookie('c_id', $city['id'], time() + 3600, '/');

            $this->assign("province", $province);
            $this->assign("city", $city);
        }

        $about = M('\\model\\AboutModel')->table('bl_about')->select()[0];
        $last = M('\\model\\BlogModel')->table('bl_blog')->field('bl_blog.*, bl_cate_category.name')->join('bl_cate_category on bl_cate_category.id = bl_blog.c_c_id')->order('bl_blog.post_date DESC')->limit(6)->select();

        $this->assign('about', $about);
        $this->assign('last', $last);
 	 	$this->display('index/index.html');
 	}

    public function setCity(){
        $province = isset($_GET['province']) ? trim($_GET['province']): '广东';
        $city = isset($_GET['city']) ? trim($_GET['city']): '广州';

        setcookie('province', $province, time() + 3600, '/');
        setcookie('city', $city, time() + 3600, '/');

        $condition = [
            'name' => $city
        ];
        $cid = M('\\model\\CateModel')->table('bl_category')->select($condition)[0]['id'];
        var_dump($city, $cid);

        setcookie('c_id', $cid, time() + 3600, '/');
    }

 }