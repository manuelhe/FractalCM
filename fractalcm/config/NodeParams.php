<?php
class NodeParams{

}
$configVars	= array(
	array(
		"param" 	=> "printButton",
		"name"		=> _LBL_PARAM_PRINTBUTTON,
		"type"		=> "select",
		"values"	=> array(
			array(
				"val"	=> 1,
				"label"	=> _LBL_SI
			),
			array(
				"val"	=> 0,
				"label"	=> _LBL_NO
			)
		)
	),
	array(
		"param"		=> "numRegs",
		"name"		=> _LBL_PARAM_NUMREGS,
		"type"		=> "select",
		"values"	=> array(
			array(
				"val"	=> 10,
				"label"	=> 10
			),
			array(
				"val"	=> 20,
				"label"	=> 20
			),
			array(
				"val"	=> 30,
				"label"	=> 30
			),
			array(
				"val"	=> 50,
				"label"	=> 50
			),
			array(
				"val"	=> 100,
				"label"	=> 100
			)
		)
	),
	array(
		"param"	=> "orderBy",
		"name"		=> _LBL_PARAM_ORDERBY,
		"type"		=> "select",
		"values"	=> array(
			array(
				"val"	=> _CONT_ORDEN,
				"label"	=> _LBL_CONT_ORDEN
			),
			array(
				"val"	=> _CONT_FECHA,
				"label"	=> _LBL_CONT_FECHA
			),
			array(
				"val"	=> _CONT_TITULO,
				"label"	=> _LBL_CONT_TITULO
			),
			array(
				"val"	=> _CONT_ID,
				"label"	=> _LBL_CONT_ID
			),
			array(
				"val"	=> _CONT_AUTOR,
				"label"	=> _LBL_CONT_AUTOR
			)
		)
	),
	array(
		"param"		=> "orderDir",
		"name"		=> _LBL_PARAM_ORDERDIR,
		"type"		=> "select",
		"values"	=> array(
			array(
				"val"	=> "ASC",
				"label"	=> _LBL_ASC
			),
			array(
				"val"	=> "DESC",
				"label"	=> _LBL_DESC
			)
		)
	),
		array(
		"param"		=> "subClass",
		"name"		=> _LBL_PARAM_SUBCLASS,
		"type"		=> "text",
		"values"	=> ""
	)
);