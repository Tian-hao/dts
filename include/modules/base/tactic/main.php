<?php

namespace tactic
{
	function init() {}
	
	function init_battle($ismeet = 0)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player','metman'));
		$chprocess($ismeet);
		$tdata['tactic']=$w_tactic;
	}
	
	function check_can_counter(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['tactic'] == 4) return 0;	//重视躲避不能反击
		return $chprocess($pa, $pd, $active);
	}
	
	function calculate_meetman_rate_by_mode($schmode)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		$r = 0;
		if ($tactic == 4) $r = -10;		//重视躲避不容易遇见敌人
		return $chprocess($schmode) + $r;
	}
	
	function calculate_meetman_obbs(&$edata)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player','tactic'));
		return $chprocess($edata)+$tactic_meetman_obbs[$tactic];
	}
	
	function calculate_hide_obbs(&$edata)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player','tactic'));
		return $chprocess($edata)+$tactic_hide_obbs[$edata['tactic']];
	}
	
	function calculate_counter_rate(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$r = 0;
		if($pa['tactic'] == 3) $r = 30;
		return $chprocess($pa, $pd, $active) + $r;
	}
	
	function get_att_multiplier(&$pa,&$pd,$active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','tactic'));
		if ($pa['is_counter'])		//应战策略的进攻加成只在反击时才有用
		{
			return $chprocess($pa,$pd,$active)*(1+$tactic_attack_modifier[$pa['tactic']]/100);
		}
		else  return $chprocess($pa,$pd,$active);
	}
	
	function get_def_multiplier(&$pa,&$pd,$active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','tactic'));
		//应战策略的防御加成也是始终生效的
		return $chprocess($pa,$pd,$active)*(1+$tactic_defend_modifier[$pd['tactic']]/100);
	}
	
	function get_trap_damage()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		$damage = $chprocess();
		if ($tactic == 2) if (rand(0,99)<75) $damage = round($damage * 0.75);	//防御姿态大概率降低陷阱伤害
		return $damage;
	}
	
	function get_trap_escape_rate()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		if ($tactic == 4) return $chprocess()+20; else return $chprocess();	//躲避姿态提高陷阱回避率
	}
	
	function tactic_change($ntactic)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player','tactic','logger'));
		$ntactic=(int)$ntactic;
		if ($tactic_player_usable[$ntactic])
		{
			$log .= "应战策略变为<span class=\"yellow\">{$tacinfo[$ntactic]}</span>。<br> ";
			$tactic = $ntactic;
		} 
		else  $log .= "这是什么奇怪的应战策略啦！<br> ";
	}
	
	function act()	
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player','tactic'));
		
		if($mode == 'special' && strpos($command,'tac') === 0)
		{
			tactic_change(substr($command,3,1));
			$mode = 'command';
			return;
		}
		$chprocess();
	}
}

?>
