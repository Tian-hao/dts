<?php

namespace skill209
{
	function init() 
	{
		define('MOD_SKILL209_INFO','club;');
		eval(import_module('clubbase'));
		$clubskillname[209] = '舞钢';
	}
	
	function acquire209(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost209(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function check_unlocked209(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return $pa['lvl']>=15;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function skill_onsave_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
		
	function get_weapon_fluc_percentage(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ((\skillbase\skill_query(209,$pa))&&(check_unlocked209($pa))&&($pa['wep_kind']=='K'))
			return abs($chprocess($pa, $pd, $active));
		else  return $chprocess($pa, $pd, $active);
	}
}

?>
