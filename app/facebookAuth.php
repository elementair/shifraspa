<?php

	class FacebookAuth
	{

		protected $facebook;
		protected $facebookUrl = "http://localhost/shifra/callback.php";


		public function __construct(Facebook\Facebook $facebook){
			$this->facebook = $facebook;
		}

		public function getHelper(){
			return $this->facebook->getRedirectLoginHelper();

		}

		public function getAuthUrl(){
			return $this->getHelper()->getLoginUrl($this->facebookUrl);
		}

		public function isLogin(){
			return isset($_SESSION['id_facebook']);
		}
	}

 ?>