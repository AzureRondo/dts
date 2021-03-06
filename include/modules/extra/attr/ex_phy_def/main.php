<?php

namespace ex_phy_def
{
	global $def_kind;
	
	//各类武器对应的防御列表
	//全系防御的作用是防御所有在下列列表中的武器
	$def_kind = Array(
		'P' => 'P',
		'K' => 'K',
		'G' => 'G',
		'C' => 'C',
		'D' => 'D',
		'F' => 'F',
		'J' => 'G'
	);
	
	function init() 
	{
		eval(import_module('itemmain'));
		$itemspkinfo['P'] = '防殴';
		$itemspkinfo['K'] = '防斩';
		$itemspkinfo['G'] = '防弹';
		$itemspkinfo['C'] = '防投';
		$itemspkinfo['D'] = '防爆';
		$itemspkinfo['F'] = '防符';
		$itemspkinfo['A'] = '全系防御';
	}
	
	function get_ex_phy_def_proc_rate(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 90;
	}
	
	//注意这个函数返回的必须是一个数组
	function check_physical_def_attr(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('ex_phy_def','logger'));
		if (isset($def_kind[$pa['wep_kind']])) 
		{
			$ex_def_array = \attrbase\get_ex_def_array($pa, $pd, $active);
			if (in_array($def_kind[$pa['wep_kind']], $ex_def_array) || in_array('A', $ex_def_array))
			{
				$proc_rate = get_ex_phy_def_proc_rate($pa, $pd, $active);
				$dice = rand(0,99);
				if ($dice<$proc_rate)
				{
					if ($active)
						$log .= "<span class=\"yellow\">{$pd['name']}的装备使你的攻击伤害减半了！</span><br>";
					else  $log .= "<span class=\"yellow\">你的装备使{$pa['name']}的攻击伤害减半了！</span><br>";
					return Array(0.5);
				}
				else
				{
					if ($active)
						$log .= "<span class=\"yellow\">{$pd['name']}的装备没能发挥攻击伤害减半的效果！</span><br>";
					else  $log .= "<span class=\"yellow\">你的装备没能发挥攻击伤害减半的效果！</span><br>";
					return Array();
				}
			}
		}
		return Array();
	}
	
	function get_physical_dmg_multiplier(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return array_merge(check_physical_def_attr($pa, $pd, $active), $chprocess($pa, $pd, $active));
	}
}

?>
