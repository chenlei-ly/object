<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if($request->session()->has('adminname')){
            //dd(session('nodelist'));
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            $cn=strtolower($func[0]);
            $an=$func[1];
            $nodelist = session('nodelist');
            if(empty($nodelist[$cn]) || !in_array($an,$nodelist[$cn])){
                return redirect('/admin/create')->with('error','对不起,您没有权限,请联系管理员');
            }
            return $next($request);
        } else {
            return redirect('admin');
        }
        
    }
}
