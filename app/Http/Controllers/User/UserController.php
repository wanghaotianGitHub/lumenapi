<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/10 0010
 * Time: 11:46
 */
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
class UserController extends Controller{
    //登录
    public function login(Request $request){
        $name = $request->input('name');
        $pwd = $request->input('pwd1');
//        print_r($name);print_r($pwd);
        $u = UserModel::where(['name'=>$name])->first();
        if($u){
            //验证登录
            if($u['pwd1'] == $pwd){
                echo "登录成功";
            }else{
                echo "密码错误";
            }
        }else{
            //用户不存在
            echo "用户不存在";
        }
    }
    //注册
    public function reg(Request $request){
        $name = $request->input('name');
        $pwd1 = $request->input('pwd1');
        $pwd2 = $request->input('pwd2');
        $where = [
            'name'=>$name,
            'pwd1'=>$pwd1,
            'pwd2'=>$pwd2,
        ];
        $array = DB::table('user')->insertGetId($where);
        var_dump($array);
    }
    //修改密码
    public function changepwd(Request $request){
        $pwd1 = $request->input('pwd1');
        $array = DB::table("user")->update(['pwd1'=>$pwd1]);
        var_dump($array);die;
    }
    //天气
    public function wxEvent(Request $request){
            $city = $request->input('city');
            $url = "http://api.k780.com/?app=weather.future&weaid=$city&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
            $response = file_get_contents($url);
            $array = json_decode($response,true);
            $msg = '';
            if($array['success'] == '1') {
                foreach ($array['result'] as $key => $value) {
                    $msg .= $value['days'] . " " . $value['week'] . " " . $value['citynm'] . " " . $value['weather'] . " \r\n";
                }
            }
            return $msg;
    }
    public function mi(){
        $res = file_get_contents("php://input");
        $data = base64_decode($res);
        echo "解密结果: ".$data;
    }
    public function Symmetric(){
        $method = 'AES-128-CBC';
        $key = "啊啦啦啦啦";
        $iv = "王浩天王王1";
        $res = file_get_contents("php://input");
        $dec_data = openssl_decrypt($res,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "解密结果: ".$dec_data;
    }
    public function FSymmetric(){
//        $res = $_GET['ii'];
        $r = file_get_contents("php://input");
        $arr = openssl_get_publickey('file://'.storage_path('miyao/rsa_public_key.pem'));
//        $aa = openssl_verify($r,$dat,$arr);
        openssl_public_decrypt($r,$dat,$arr);
        echo "解密结果: ".$dat;
    }
}