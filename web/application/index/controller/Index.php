<?php
	namespace app\index\controller;
	use  think\Controller;
  use think\Request;
  use think\Db;
	class Index extends Controller
{
	public function index(){
       // var_dump(__static__) ;
       return $this->fetch();

  
	}
    public function page(){
       // var_dump(__static__) ;
       return $this->fetch();
  
    }
    public function article(){
       // var_dump(__static__) ;
       return $this->fetch();
  
    }
    public function imglist(){
       // var_dump(__static__) ;
       return $this->fetch();

  
    }
    public function artlist(){
       // var_dump(__static__) ;
       return $this->fetch();
  
    }
    public function deal(Request $request){
      
    }
    
   
}