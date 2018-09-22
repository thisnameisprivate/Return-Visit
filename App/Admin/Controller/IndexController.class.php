<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    /*
     *  @@ hospitals select 首页科室选择下拉框
     *  @param null
     *  return display
     * */
    public function index () {
        $hospital = M('hospital');
        $hospitals = $hospital->field(array('hospital', 'tableName'))->select();
        $this->assign('hospitals', $hospitals);
        $this->display();
    }
    /*
     *  @@ department system page
     * */
    public function departMent () {
        $this->display();
    }
    /*
     *  @@ departMent system rendering
     *  @param null
     *  return departMent Type: josn
     * */
    public function departmentRender () {
        $departMent = M('hospital');
        $dpeartMents = $departMent->select();
        $departMentCount = $departMent->count();
        $this->arrayRecursive($dpeartMents, 'urlencode', true);
        $jsonDepart = urldecode(json_encode($dpeartMents));
        $departList = "{\"code\":0, \"msg\":\"\", \"count\": $departMentCount, \"data\":$jsonDepart}";
        $this->ajaxReturn($departList, 'eval');
    }
    /*
     *  @@ delete department
     *  @param null
     *  return true or false
     * */
    public function delDepartMent () {
        if (! is_numeric($_GET['id'])) return false;
        $id = $_GET['id'];
        $delData = M('hospital');
        $resolve = $delData->where("id = $id")->delete();
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  @@ add department
     *  @param null
     *  return true of false
     * */
    public function addDepartMent () {
        $hospital = json_decode($_GET['hospital'],true);
        $hospital['hospital'] = $hospital['hospital'];
        $hospitals = M('hospital');
        $hospitals->add($hospital);
        if ($hospital) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  @@ login success
     *  @Pparam null
     *  return display
     * */
    public function visit () {
        $this->display();
    }
    /*
     *  首页
     * */
    public function echarts () {
        $this->display();
    }
    /*
     *  @@ interval page
     *  @param null
     *  return $visitList Type: json
     * */
    public function visitCheck () {
        $cookieTable = cookie('tableName');
        if ($cookieTable == '') $this->ajaxReturn('数据查询异常', 'eval');
        $hospital = M($cookieTable);
        $page = $_GET['page'];
        $hospitalVistCount = $hospital->count();
        $totalPage = 25;
        $hospitalVisit = $hospital->limit(($page - 1) * $totalPage, $totalPage)->order('id desc')->select();
        $this->arrayRecursive($hospitalVisit, 'urlencode', true);
        $jsonVisit = urldecode(json_encode($hospitalVisit));
        $interval = ceil($hospitalVistCount / $totalPage);
        $visitList = "{\"code\":0, \"msg\":\"\", \"count\": $hospitalVistCount, \"data\":$jsonVisit}";
        $this->ajaxReturn($visitList, 'eval');
    }
    /*
     *  @@ delete tool data.
     *  @param null
     *  return true or false
     * */
    public function delete () {
        if (! is_numeric($_GET['id'])) return false;
        $id = $_GET['id'];
        $delData = M('nkvisit');
        $resolve = $delData->where("id = $id")->delete();
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  @@ detail tool data
     *  @param null
     *  return tool data
     * */
    public function detail () {
        if (! is_numeric($_GET['id'])) return false;
        $id = $_GET['id'];
        $detData = M('nkvisit');
        $response = $detData->where("id = $id")->select();
        $this->arrayRecursive($response, 'urlencode', true);
        $response = urldecode(json_encode($response));
        if ($response) {
            $this->ajaxReturn($response, 'eval');
        } else {
            $this->ajaxReturn('not find value:0');
        }
    }
    /*
     *  @@ isCookie have?
     *  @param null
     *  if not have Cookie dipslay login.
     * */
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
    /*
     *  @@ JsonString handle
     *  @param $array Type: array
     *  @param $function Type: string
     *  @param $apply_to_keys_also Type: boolean
     *  return jsonString
     * */
    public function arrayRecursive(&$array, $function, $apply_to_keys_also = false) {
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