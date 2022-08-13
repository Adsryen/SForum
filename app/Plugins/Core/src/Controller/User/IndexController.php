<?php


namespace App\Plugins\Core\src\Controller\User;


use App\Plugins\Core\src\Lib\Sms\Sms;
use App\Plugins\Topic\src\Models\Topic;
use App\Plugins\User\src\Middleware\LoginMiddleware;
use App\Plugins\User\src\Models\User;
use App\Plugins\User\src\Models\UsersNotice;
use Exception;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Request;
use Psr\Http\Message\ResponseInterface;

#[Controller]
#[Middleware(LoginMiddleware::class)]
class IndexController
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    public \Psr\Log\LoggerInterface $logger;

    /**
     * 强制验证邮箱
     */
    #[GetMapping(path: "/user/ver_email")]
    public function user_ver_email()
    {
		if(User::query()->where('id',auth()->id())->value('email_ver_time')){
			return redirect()->url("/")->with("info","你已验证邮箱,无需重复操作")->go();
		}
        return view("App::user.ver_email");
    }

    #[PostMapping(path: "/user/ver_email")]
    public function user_ver_email_post(){
        $send = request()->input('send',null);
        $captcha = request()->input('captcha',null);
        if($send==="send"){
            if(!core_user_ver_email()->ifsend()){
                return redirect()->back()->with("danger","冷却期间,请".core_user_ver_email()->sendTime()."秒后再试")->go();
            }
            core_user_ver_email()->send(auth()->id());
            return redirect()->back()->with("success","验证码邮件已发送")->go();
        }
        if(!$captcha){
            return redirect()->back()->with("danger","请填写验证码")->go();
        }
        if(!core_user_ver_email()->check($captcha)){
            return redirect()->back()->with("danger","验证码错误")->go();
        }
        User::query()->where("id",auth()->id())->update([
           "email_ver_time" => date("Y-m-d H:i:s")
        ]);

        auth()->refresh(auth()->id());
        return redirect()->url("/")->with("success","验证通过")->go();
    }

    /**
     * 个人中心
     */
    #[GetMapping(path: "/user")]
    public function user(){
        return redirect()->url('/users/'.auth()->data()->username.".html")->go();
    }

    // 草稿
    #[GetMapping("/user/draft")]
    public function draft(){
        $page = Topic::query()
            ->where(['user_id' => auth()->id(),'status' => 'draft'])
            ->with("tag","user")
            ->orderBy("topping","desc")
            ->orderBy("id","desc")
            ->paginate(get_options("topic_home_num",15));

        return view("User::draft",["page" => $page]);
    }

    // 草稿
    #[GetMapping("/draft/{id}")]
    public function draft_show($id){
        if(!Topic::query()->where('id',$id)->exists()) {
            return admin_abort("页面不存在",404);
        }
        $data = Topic::query()
            ->where('id', $id)
            ->with("tag","user","topic_updated")
            ->first();
        $quanxian = false;
        if(auth()->id()==$data->user_id){
            $quanxian = true;
        }
        if(Authority()->check("admin_view_draft_topic")){
            $quanxian = true;
        }
        if($quanxian===false){
            return admin_abort("无权预览此草稿",401);
        }
        $shang = Topic::query()->where([['id','<',$id],['status','publish']])->select('title','id')->orderBy('id','desc')->first();
        $xia = Topic::query()->where([['id','>',$id],['status','publish']])->select('title','id')->orderBy('id','asc')->first();
        $sx = ['shang' => $shang,'xia' => $xia];
        return view('App::topic.show.draft',['data' => $data,'get_topic' => $sx]);
    }

    // 个人通知
    #[GetMapping(path:"/user/notice")]
    public function notice(): ResponseInterface
    {
		return redirect()->url('/notice')->go();
    }
    // 个人收藏
    #[GetMapping(path:"/user/collections")]
    public function collections(){
        return redirect()->url("/users/collections/".auth()->id())->go();
    }

    // 强制验证手机
    #[GetMapping(path:"/user/ver_phone")]
    public function ver_phone(){
        return view("App::user.ver_phone");
    }

    // 强制验证手机 -发短信
    #[PostMapping(path:"/user/ver_phone/send")]
    public function ver_phone_send(Request $request){
        $phone = $request->input("phone");

        if(!$phone){
            return redirect()->url("/user/ver_phone")->with("info","请输入手机号")->go();
        }
        if(User::query()->where('phone',$phone)->exists()){
            return redirect()->url("/user/ver_phone")->with("info","此手机号已被其他用户使用")->go();
        }
        cache()->set('user.verify.phone.'.auth()->id(),time(),86400);
        $code = random_int(10000,99999);
        cache()->set('user.verify.phone.code.'.auth()->id(),['code' => $code,'phone' => $phone],3600);
        (new Sms())->send([''.$phone],[''.$code,'60']);
        return redirect()->url("/user/ver_phone")->with("success","验证码已发送")->go();
    }

    // 强制验证手机 -验证
    #[PostMapping(path:"/user/ver_phone")]
    public function ver_phone_post(Request $request){
        $code = $request->input("code");
        if(!$code){
            return redirect()->url("/user/ver_phone")->with("info","请输入验证码")->go();
        }


        if(!cache()->has('user.verify.phone.code.'.auth()->id())){
            return redirect()->url("/user/ver_phone")->with("info","验证码已过期")->go();
        }
        $data = cache()->get('user.verify.phone.code.'.auth()->id());
        if((string)$code!==(string)$data['code']){
            return redirect()->url("/user/ver_phone")->with("danger","验证码错误!")->go();
        }
        User::query()->where('id',auth()->id())->update([
            'phone' => $data['phone'],
            'phone_ver_time' => date("Y-m-d H:i:s")
        ]);

        auth()->refresh(auth()->id());
        return redirect()->url("/")->with("success","绑定成功!")->go();
    }
}