<?php
/***************************************************************************
 * 
 * Copyright (c) 2010 babeltime.com, Inc. All Rights Reserved
 * $Id: hell_tower.script.php 254629 2016-08-03 13:14:35Z GuohaoZheng $
 * 
 **************************************************************************/

 /**
 * @file $HeadURL: svn://192.168.1.80:3698/C/tags/card/rpcfw/rpcfw_1-0-41-55/module/tower/script/hell_tower.script.php $
 * @author $Author: GuohaoZheng $(zhengguohao@babeltime.com)
 * @date $Date: 2016-08-03 13:14:35 +0000 (Wed, 03 Aug 2016) $
 * @version $Revision: 254629 $
 * @brief 
 *  
 **/
require_once dirname ( dirname( dirname ( dirname ( __FILE__ ) ) ) ) . "/lib/ParserUtil.php";
require_once dirname ( dirname( dirname ( dirname ( __FILE__ ) ) ) ) . "/def/Tower.def.php";

$csvFile = 'nightmare_tower.csv';
$outFileName = 'HELL_TOWER';

if( isset($argv[1]) &&  $argv[1] == '-h' )
{
    exit("usage: $csvFile $outFileName \n");
}

if ( $argc < 3 )
{
    echo "Please input enough arguments:!TOWER.csv output\n";
    trigger_error ("input error parameters.");
}

$ZERO = 0;
$confIndex = array(
    HellTowerFloorDef::ID => $ZERO,
    HellTowerFloorDef::LEVEL => ++$ZERO,
    HellTowerFloorDef::NUM => ++$ZERO,
    HellTowerFloorDef::BUY_RESET_GOLD => ++$ZERO,
    HellTowerFloorDef::MAX_RESET_NUM => ++$ZERO,
    HellTowerFloorDef::LOSE_NUM => ++$ZERO,
    HellTowerFloorDef::TIME => ++$ZERO,
    HellTowerFloorDef::BASE_GOLD => ++$ZERO,
    HellTowerFloorDef::GROW_GOLD => ++$ZERO,
    HellTowerFloorDef::MAX_FAIL_NUM => ++$ZERO,
    HellTowerFloorDef::SWEEP_GOLD => ++$ZERO,
);

// 读取 —— 副本选择表.csv
$file = fopen($argv[1]."/$csvFile", 'r');
// 略过前两行
$data = fgetcsv($file);
$data = fgetcsv($file);

$conf = array();
while ( TRUE )
{
    $data = fgetcsv($file);
    
    if ( empty( $data ) || empty( $data[0] ) )
    {
        break;
    }
    
    foreach ( $confIndex as $key => $index )
    {
        $conf[$key] = intval( $data[$index] );
    }
}

fclose($file);
//将内容写入COPY文件中
$file = fopen($argv[2]."/$outFileName", 'w');
fwrite($file, serialize($conf));
fclose($file);

/* vim: set ts=4 sw=4 sts=4 tw=100 noet: */