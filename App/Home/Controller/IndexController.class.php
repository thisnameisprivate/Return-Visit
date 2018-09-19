<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index () {
        $this->display();
    }
    public function login () {
        if ($_POST) {
            $user = M('user');
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = $user->where("username = '%s' and password = '%s'", array($username, md5($password)))->select();
            if ($result) {
                cookie('username', $username, 3600);
                $this->success("login success", U("Admin/Index/index"));
            } else {
                $this->error("login failed", U("Home/Index/index"));
            }
        }
    }
}