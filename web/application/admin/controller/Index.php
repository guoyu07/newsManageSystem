<?php
	namespace app\admin\controller;
	use  think\Controller;
	use think\Request;
	use think\Db;
	use think\Session;
	class Index extends Controller{

		public function index(){
			if($this->checkLogin()){
				$this->assign("username",Session::get('username'));
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}
			
		}
		public function add(Request $request){
			if($this->checkLogin()){
				$this->assign("username",Session::get('username'));
				if($request->isPost()){
					$data=input('post.');
					$res=db('user')->insert($data);
					if($res){
						return $this->success('添加成功','admin/index/lists');
					}else{
						return $this->success('添加失败');
					}
				}
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}
			
		}
		public function lists(){
			if($this->checkLogin()){
				$admins=Db::table('think_user')->paginate(7);
				$this->assign('username',Session::get("username"));
				$this->assign('admins',$admins);
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}	
			
		}
		public function login(Request $request){
			if($request->isPost()){
				$username=$request->param('username');
				$password=$request->param('password');
				$flag=Db::table('think_user')->where('username',$username)->where('password',$password)->find();
				if($flag){
					Session::set('username',$username);
					return $this->success('登录成功','admin/Index/index');
				}else{
					return $this->error('users\' password error');
				}
				
			}
			return $this->fetch();
		}
		public function edit(Request $request){
			if($this->checkLogin()){
				if($request->isPost()){
					$data=input('post.');
					$res=Db::table('think_user') ->where('id', $request->param('id'))->update($data);
					return $this->success('success','admin/index/lists');
				}
				$data=Db::table('think_user')->where('id',$request->param('id'))->find();
				$this->assign('username',$data['username']);
				$this->assign('id',$data['id']);
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}		
		}
		public function delete($id){
			$res=Db::table('think_user')->delete($id);
			if($res){
				return $this->success('删除成功','admin/index/lists');
			}else{
				return $this->error('删除失败');
			}
		}
		public function articleDelete($id){
			$res=Db::table('think_article')->delete($id);
			if($res){
				return $this->success('删除成功','admin/index/articleList');
			}else{
				return $this->error('删除失败');
			}
		}
		public function checkLogin(){
			if(Session::has('username')){
				return true;
			}else{
				return false;
			}
			
		}
		public function logout(){
			Session::delete('username');
			return $this->redirect('/login');
		}
		public function articleList(){
			if($this->checkLogin()){
				$this->assign("username",Session::get('username'));
				$article=Db::table('think_article')->paginate(7);

				$this->assign('article',$article);
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}	
		}

		public function articleEdit(Request $request){
			if($this->checkLogin()){
				if($request->isPost()){
					$data=input('post.');
					Db::table('think_article')->data(['title'=>$data["title"],'content'=>$data["content"]])->insert();
					return $this->success('success','admin/index/articleList');
				}
				$data=Db::table('think_user')->where('id',$request->param('id'))->find();
				$this->assign('username',$data['username']);
				$this->assign('id',$data['id']);
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}		
		}
		public function articleAdd(Request $request){
			if($this->checkLogin()){
				$this->assign("username",Session::get('username'));
				if($request->isPost()){
					$data=input('post.');
					Db::table('think_article')->data(['title'=>$data["title"],'content'=>$data["content"]])->insert();
					return $this->success('success','admin/index/articleList');
				}
				$data=Db::table('think_article')->where('id',$request->param('id'))->find();
				$this->assign('title',$data['title']);
				$this->assign('content',$data['content']);
				$this->assign('id',$data['id']);
				return $this->fetch();
			}else{
				return $this->redirect('/login');
			}		
		}
	}