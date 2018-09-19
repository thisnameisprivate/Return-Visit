<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index () {
        $hospital = M('hospital');
        $hospitals = $hospital->field('hospital')->select();
        $this->assign('hospitals', $hospitals);
        $this->display();
    }
    public function visit () {
        $this->assign('url', "{:U('Admin/Index/visitCheck')}");
        $this->display();
    }
    public function visitCheck () {
        $hospital = M('nkvisit');
        $hospitalVisit = $hospital->select();
        $this->arrayRecursive($hospitalVisit, 'urlencode', true);
        $json = json_encode($hospitalVisit);
        $jsonVisit = urldecode($json);
        $hospitalVistCount = $hospital->count();
        $visitList = "{\"code\":0, \"msg\":\"\", \"count\": '{$hospitalVistCount}', 'data':$jsonVisit}";
        print_r($visitList);
        return $visitList;
    }
    public function returnId () {

    }
    public function isCookie () {
        $cookieVal = cookie('username');
        if ($cookieVal) {
            $user = M('user');
            $result = $user->where("username = '%s'", $cookieVal)->select();
            if ($result) {
                // hava cookie time.
                // code
            } else {
                $this->error("login failed", U("Home/Index/index"));
            }
        }
    }
    public function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++$recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }

            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }
}