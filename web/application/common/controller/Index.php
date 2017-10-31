<?php
	namespace app\common\controller;
	use app\common\Index as commonIndex;
	class Index{
		pubic function index(){
			return "this is common Index index";
		}
		public function common(){
			$commonIndex=new commonIndex();
			return $commonIndex->index();
		}
	}
