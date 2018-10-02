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
        $hospitals = M('hospital');
        $resolve = $hospitals->add($hospital);
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  customser service page
     * */
    public function custservice () {
        $this->display();
    }
    /*
     *  customser service data
     *  @param null
     *  return $customerList Type: json
     * */
    public function custserviceCheck () {
        $customer = M('custservice');
        $custservice = $customer->select();
        $customerCount = $customer->count();
        $this->arrayRecursive($custservice, 'urlencode', true);
        $jsonCustomer = urldecode(json_encode($custservice));
        $customerList = "{\"code\":0, \"msg\":\"\", \"count\": $customerCount, \"data\":$jsonCustomer}";
        $this->ajaxReturn($customerList, 'eval');
    }
    /*
     *  customer service delte
     *  @param null
     *  return ture or false
     * */
    public function custserviceDelete () {
        if (! is_numeric($_GET['id'])) return false;
        $id = $_GET['id'];
        $delData = M('custservice');
        $resolve = $delData->where("id = $id")->delete();
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  customer service add
     *  @param null
     *  return ture or false
     * */
    public function custserviceAdd () {
        $cusomerService = json_decode($_GET['custservice'],true);
        $cusomer = M('custservice');
        $resolve = $cusomer->add($cusomerService);
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  user page
     * */
    public function user () {
        $this->display();
    }
    /*
     *  user data
     *  @param null
     *  return userList
     * */
    public function userCheck () {
        $customer = M('user');
        $user = $customer->select();
        $userCont = $customer->count();
        $this->arrayRecursive($user, 'urlencode', true);
        $jsonUser = urldecode(json_encode($user));
        $userList = "{\"code\":0, \"msg\":\"\", \"count\": $userCont, \"data\":$jsonUser}";
        $this->ajaxReturn($userList, 'eval');
    }
    /*
     *  user delete
     *  @param null
     *  return true or false
     * */
    public function userDelete () {
        if (! is_numeric($_GET['id'])) return false;
        $id = $_GET['id'];
        $delData = M('user');
        $resolve = $delData->where("id = $id")->delete();
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  user add
     *  @param null
     *  return true or false
     * */
    public function userAdd () {
        $userList = json_decode($_GET['user'],true);
        $userList['username'] = $userList['username'];
        $userList['password'] = md5($userList['password']);
        $user = M('user');
        $resolve = $user->add($userList);
        if ($resolve) {
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
        $cookieTable = cookie('tableName');
        if ($cookieTable == '') return false;
        $isTable = M()->query("show tables like '{$cookieTable}'");
        if (! $isTable) {
            // Create table, return true or false
            if (! $this->createTable($cookieTable)) return false;
        }
        $diseases = M('alldiseases');
        $diseasesList = $diseases->where("tableName = '{$cookieTable}'")->field('diseases')->order('id')->select();
        $this->assign('diseasesList', $diseasesList);
        // select * from status
        $status = M('status');
        $statusValue = $status->order('id')->select();
        $this->assign('statusValue', $statusValue);
        // select * from visitstatus
        $visitstatus = M('visitstatus');
        $visitstatusValue = $visitstatus->order('id')->select();
        $this->assign('visitstatusValue', $visitstatusValue);
        // select * from custservice
        $custservice = M('custservice');
        $custservices = $custservice->order('id')->select();
        $this->assign('custservices', $custservices);
        $this->display();
    }
    /*
     *  Home page
     * */
    public function echarts () {
        $cookie = cookie('tableName');
        $custservice = M('custservice');
        $customer = $custservice->field('custservice')->select();
        foreach($customer as $k => $v) {
            foreach ($v as $c => $d) {
                $customers[] =  $d;
            }
        }
        $master = M($cookie);
        $loading = $master->where("status = '等待' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $arrived = $master->where("status = '已到' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $arrivedOut = $master->where("status = '未到' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $reserUnde = $master->where("status = '预约未定' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $loss = $master->where("status = '全流失' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $halfLoss = $master->where("status = '半流失' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $hasBeen = $master->where("status = '已诊治' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        $data['loading'] = $loading;
        $data['arrived'] = $arrived;
        $data['arrivedOut'] = $arrivedOut;
        $data['reserUnde'] = $reserUnde;
        $data['loss'] = $loss;
        $data['halfLoss'] = $halfLoss;
        $data['hasBeen'] = $hasBeen;

        for ($i = 0; $i < count($customers); $i ++) {
            $No[$customers[$i]] = $master->where("name = '{$customers[$i]}' and status = '已到' AND date_format(addtime, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")->count();
        }
        arsort($No, SORT_NUMERIC);
        foreach ($No as $k => $v) {
            $name[] = $k;
            $sort[] = $v;
        }
        array_splice($name, 5);
        $this->assign('name', $name);
        $name = implode('\',\'', $name);
        $name = "'{$name}'";
        $this->assign('names', $name);
        $this->assign('sort', $sort);
        $this->assign('data', $data);
        $this->display();
    }
    /*
     *  @@ interval page
     *  @param null
     *  return $visitList Type: json
     * */
    public function visitCheck () {
        $cookieTable = cookie('tableName');
        $hospital = M($cookieTable);
        if ($_GET['search'] == '') { // search...
            $hospitalVistCount = $hospital->count();
            $hospitalVisit = $hospital->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
        } else {
            if (is_string($_GET['search'])) {
                $username['username'] = array('like', "%{$_GET['search']}%");
                $hospitalVistCount = $hospital->where($username)->count();
                $hospitalVisit = $hospital->where($username)->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
            }
            if (is_numeric($_GET['search'])) {
                $phone['clientPhone'] = array('like', "%{$_GET['search']}%");
                $hospitalVistCount = $hospital->where($phone)->count();
                $hospitalVisit = $hospital->where($phone)->limit(($page = $_GET['page'] - 1) * $_GET['limit'], $_GET['limit'])->order('id desc')->select();
            }
        }
        $this->arrayRecursive($hospitalVisit, 'urlencode', true);
        $jsonVisit = urldecode(json_encode($hospitalVisit));
        $interval = ceil($hospitalVistCount / $totalPage);
        $visitList = "{\"code\":0, \"msg\":\"\", \"count\": $hospitalVistCount, \"data\": $jsonVisit}";
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
        $cookie = cookie('tableName');
        $delData = M($cookie);
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
     *  @@ add tool data
     *  @param null
     *  return tool data
     * */
    public function addData () {
        $data = json_decode($_GET['data'],true);
        print_r($data);
        $cookie = cookie('tableName');
        // data modify. all order desc select
        if (is_null($data['sex'])) {
            $data['sex'] = '男';
        } else {
            $data['sex'] = '女';
        }
        $custservice = M('custservice')->field('custservice')->order('id')->select();
        $data['name'] = $custservice[$data['name']]['custservice'];
        $visitStatus = M('visitstatus')->field('visitstatus')->order('id')->select();
        $data['visitStatus'] = $visitStatus[$data['visitStatus']]['visitstatus'];
        $status = M('status')->field('status')->order('id')->select();
        $data['status'] = $status[$data['status']]['status'];
        $diseases = M('alldiseases')->where("tableName = '{$cookie}'")->field('diseases')->order('id')->select();
        $data['options'] = $diseases[$data['options']]['diseases'];
        $datas = M($cookie);
        $resolve = $datas->add($data);
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
        }
    }
    /*
     *  @@ edit tool data
     *  @param null
     *  return true or false;
     * */
    public function editData () {
        $data = json_decode($_GET['data'], true);
        $id = $_GET['id'];
        $cookie = cookie('tableName');
        // data modify. all order desc select
        if (is_null($data['sex'])) {
            $data['sex'] = '男';
        } else {
            $data['sex'] = '女';
        }
        $custservice = M('custservice')->field('custservice')->order('id')->select();
        $data['name'] = $custservice[$data['name']]['custservice'];
        $visitStatus = M('visitstatus')->field('visitstatus')->order('id')->select();
        $data['visitStatus'] = $visitStatus[$data['visitStatus']]['visitstatus'];
        $status = M('status')->field('status')->order('id')->select();
        $data['status'] = $status[$data['status']]['status'];
        $diseases = M('alldiseases')->where("tableName = '{$cookie}'")->field('diseases')->order('id')->select();
        $data['options'] = $diseases[$data['options']]['diseases'];
        $datas = M($cookie);
        $resolve = $datas->where("id = '{$id}'")->save($data);
        if ($resolve) {
            $this->ajaxReturn(true, 'eval');
        } else {
            $this->ajaxReturn(false, 'eval');
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
    /*
     *  create new table
     *  @param tableName
     *  return true or false
     * */
    public function createTable ($tableName) {
        $sql = <<<sql
                CREATE TABLE `$tableName` (
                `id` int AUTO_INCREMENT,
                `status` varchar(30) NOT NULL DEFAULT 0,
                `phone` varchar(20) NOT NULL,
                `clientPhone` varchar(20) NOT NULL,
                `name` varchar(20) NOT NULL,
                `options` varchar(20) NOT NULL,
                `visitStatus` varchar(25) NOT NULL,
                `money` varchar(30) NOT NULL DEFAULT 0,
                `username` varchar(20) NOT NULL DEFAULT 0,
                `sex` varchar(20) NOT NULL DEFAULT 10003,
                `addtime` timestamp DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;	
sql;
        if (M()->query($sql)) return true;
        return false;
    }
}