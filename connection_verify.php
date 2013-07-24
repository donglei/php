<?php
/**
 * @author donglei
 *
 */
class System_Helper_GMVerify
{
  const GM_VERIFY_KEY = 'jEwODgxNGEyMDmFlODM2ODDDD';
	
	/**
	 * build query string
	 * @param arra $data
	 */
	public static function buildQueryString(array $data) 
	{
		$data['gm_verify'] =  self::getVerifyCode($data);		
		return http_build_query($data);
	}
	
	/**
	 * getVerifyCode
	 * @param array $data
	 */
	public static function getVerifyCode(array $data)
	{
		ksort($data);// key 升序排列
		$tmp_string = http_build_query($data);
		$tmp_string .= self::GM_VERIFY_KEY; 
		return md5($tmp_string);
	}
	
	/**
	 * parseQueryString
	 * @param string $data
	 */
	public static function parseQueryString($str)
	{
		$data = parse_str($str);
		$tmp = $data;
		unset($tmp['gm_verify']);
		$gm_verify = self::getVerifyCode($tmp);
		if ($gm_verify === $data['gm_verify'])
		 {
		 	return $data;
		 }
		
		return array();
	}
}
