<?php

namespace skill30
{
	//怒气消耗
	$ragecost = 30; 
	
	function init() 
	{
		define('MOD_SKILL30_INFO','club;battle;');
		eval(import_module('clubbase'));
		$clubskillname[30] = '压制';
	}
	
	function acquire30(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost30(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
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
	
	function check_unlocked30(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return $pa['lvl']>=7;
	}
	
	function get_rage_cost30(&$pa = NULL)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('skill30'));
		return $ragecost;
	}
	
	function strike_prepare(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=30) return $chprocess($pa, $pd, $active);
		if (!\skillbase\skill_query(30,$pa) || !check_unlocked30($pa))
		{
			eval(import_module('logger'));
			$log .= '你尚未解锁这个技能！';
			$pa['bskill']=0;
		}
		else
		{
			$rcost = get_rage_cost30($pa);
			if ($pa['rage']>=$rcost)
			{
				$hpcost = min($pa['hp']-1, round($pa['mhp']*0.15));
				eval(import_module('logger'));
				if ($active)
					$log.="<span class=\"lime\">你对{$pd['name']}发动了技能「压制」！</span><br>
						<span class=\"yellow\">你消耗了<span class=\"red\">{$hpcost}</span>点生命值，对敌人造成了相同的伤害！</span><br>";
				else  $log.="<span class=\"lime\">{$pa['name']}对你发动了技能「压制」！</span><br>
						<span class=\"yellow\">其消耗了<span class=\"red\">{$hpcost}</span>点生命值，对你造成了相同的伤害！</span><br>";
				$pa['rage']-=$rcost;
				$pa['hp']-=$hpcost;
				$pd['hp']-=$hpcost;
				$pa['skill30_hpcost']=$hpcost;
				addnews ( 0, 'bskill30', $pa['name'], $pd['name'] );
			}
			else
			{
				if ($active)
				{
					eval(import_module('logger'));
					$log.='怒气不足。<br>';
				}
				$pa['bskill']=0;
			}
		}
		$chprocess($pa, $pd, $active);
	}	
	
	function strike_finish(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=30) return $chprocess($pa, $pd, $active);
		$pa['dmg_dealt']+=$pa['skill30_hpcost'];
		$chprocess($pa, $pd, $active);
	}
	
	function parse_news($news, $hour, $min, $sec, $a, $b, $c, $d, $e)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player'));
		
		if($news == 'bskill30') 
			return "<li>{$hour}时{$min}分{$sec}秒，<span class=\"clan\">{$a}对{$b}发动了技能<span class=\"yellow\">「压制」</span></span><br>\n";
		
		return $chprocess($news, $hour, $min, $sec, $a, $b, $c, $d, $e);
	}
	
}

?>
