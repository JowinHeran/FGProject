<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// FGMember未確定
		$user=FgUser::model()->find('LOWER(account)=?',array(strtolower($this->username)));
		// 10/29暫時使用明碼驗證
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		// else if(!$user->validatePassword($this->password))
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->password!=$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->username=$user->account;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}