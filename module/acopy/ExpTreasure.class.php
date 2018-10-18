<?php
/***************************************************************************
 * 
 * Copyright (c) 2010 babeltime.com, Inc. All Rights Reserved
 * $Id: ExpTreasure.class.php 197890 2015-09-10 09:47:03Z TiantianZhang $
 * 
 **************************************************************************/

 /**
 * @file $HeadURL: svn://192.168.1.80:3698/C/tags/card/rpcfw/rpcfw_1-0-41-55/module/acopy/ExpTreasure.class.php $
 * @author $Author: TiantianZhang $(zhangtiantian@babeltime.com)
 * @date $Date: 2015-09-10 09:47:03 +0000 (Thu, 10 Sep 2015) $
 * @version $Revision: 197890 $
 * @brief 
 *  
 **/
class ExpTreasure extends ACopyObj
{
    public function refreshDefeatNum()
    {
        parent::refreshDefeatNum();
        return $this->copyInfo['can_defeat_num'];
    }
    
    public static function getPassReward($atkRet)
    {
        $baseId = AtkInfo::getInstance()->getBaseId();
        $reward = CopyUtil::getBasePassAward($baseId, BaseLevel::SIMPLE);
        return $reward;
    }
    
    
    public static function doneBattle($atkRet)
    {
        $copyId = AtkInfo::getInstance()->getCopyId();
        $actObj = MyACopy::getInstance()->getActivityCopyObj($copyId);
        Logger::trace('ExpTreasure doneBattle atkRet %s.',$atkRet);
        if($atkRet['pass'])
        {
            if( $actObj->subCanDefeatNum() == FALSE)
            {
                throw new FakeException('not enough defeatnum.now is %d',$actObj->getCanDefeatNum());
            }
            EnActive::addTask(ActiveDef::ACOPY);
            EnWeal::addKaPoints(KaDef::ACOPY);
            $uid = RPCContext::getInstance()->getUid();
            EnMission::doMission($uid, MissionType::ACOPY);
        }
        MyACopy::getInstance()->save();
        EnUser::getUserObj()->update();
        BagManager::getInstance()->getBag()->update();
        AtkInfo::getInstance()->saveAtkInfo();
        return array();
    }
}
/* vim: set ts=4 sw=4 sts=4 tw=100 noet: */