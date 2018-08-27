<?php


use Illuminate\Support\Facades\DB;
/**
 * Created by PhpStorm.
 * User: moTzxx
 * Date: 2017/12/28
 * Time: 17:47
 */

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}
function admin_aession(){
    $account = session( 'account' );
//    print_r($account);exit;
    $crm_admin_first = $res = DB::table('crm_admin')->where('admin_id', '=', $account['admin_name'])->first();
//    print_r($crm_admin_first);exit;
    return $crm_admin_first;
}