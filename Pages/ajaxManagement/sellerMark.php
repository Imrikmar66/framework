<?php
require_once 'ajaxHeader.php';

$PM = new PostManager();

$sellerMarkArray = array(
    "user_id",
    "seller_id"
);

$newMark = array(
    "user_id",
    "newMark",
    "markName"
);

if($PM->checkParams($sellerMarkArray)){
    
    $User = new User($PM->user_id);
    
    if(is_numeric($User->getId()) && $User->getId() > 0 ){
        
        $Seller = new Seller($PM->seller_id);
        
        if(is_numeric($Seller->getId()) && $Seller->getId() > 0 && $Seller->getUser_id() == $User->getId()){
         
            $VO = 0;
            if($Seller->isVOSeller()){
               $VO = 1; 
            }
            
            if($Seller->isVOSeller()){
                $selled_mark = Mark::getAllMarks();
            }
            else{
                $selled_mark = $Seller->getSelled_marks();
            }
            
            if($firstMark = $Seller->getSelled_marks()[0]){
                $firstMark = $firstMark->getId();
            }
            else{
                $firstMark = 0;
            }

            $datas = array(
                'marks' => $selled_mark,
                'VO' => $VO,
                'firstMark' => $firstMark
            );
            echo json_encode($datas);
        }
        
    }
    
}
else if($PM->checkParams($newMark)){
    
    $User = new User($PM->user_id);
    
    if(is_numeric($User->getId()) && $User->getId() > 0 ){
        
        $mark = new Mark();
        $mark->setName($PM->markName);
        $mark->create();
        $datas = array(
                'mark' => $mark->getId()
        );
        echo json_encode($datas);
    }
}