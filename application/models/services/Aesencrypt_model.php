<?php

class Aesencrypt_model extends CI_Model {

	private $login_key = "abcdefg";

	public function login_encrypt($password){
		return base64_encode(openssl_encrypt($password, 'AES-256-ECB', $this->login_key, OPENSSL_RAW_DATA));
	}

	public function login_decrypt($password){
		return openssl_decrypt(base64_decode($password), 'AES-256-ECB', $this->login_key, OPENSSL_RAW_DATA);
	}

}
?>