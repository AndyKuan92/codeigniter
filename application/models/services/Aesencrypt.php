<?php
namespace Services;

class Aesencrypt {

	// public function __construct(){
    //     $this->key = explode(':',env('APP_KEY'))[1]?? "ks6ZiTAZS16jGi6FGIu0SVOcvAxGRGp4E165b+5byzs=";
	// }

	private $login_key = "abcdefg";

	public function login_encrypt($password){
		return base64_encode(openssl_encrypt($password, 'AES-256-ECB', $this->login_key, OPENSSL_RAW_DATA));
	}

	public function login_decrypt($password){
		return openssl_decrypt(base64_decode($password), 'AES-256-ECB', $this->login_key, OPENSSL_RAW_DATA);
	}

}
?>