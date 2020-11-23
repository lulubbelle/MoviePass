<?php

namespace Models;

class Purchase{

    private $id;
    private $showId;
    private $userId;
    private $datePurchase;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getShowId()
    {
        return $this->showId;
    }

    public function setShowId($showId)
    {
        $this->showId = $showId;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getDatePurchase()
    {
        return $this->datePurchase;
    }

    public function setDatePurchase($datePurchase)
    {
        $this->datePurchase = $datePurchase;

        return $this;
    }
    
    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $purchase = new Purchase();
            $purchase->setId($p['ID']);
            $purchase->setShowId($p['SHOW_ID']);
            $purchase->setUserId($p['USER_ID']);
            $purchase->setDatePurchase($p['DATE_PURCHASE']);
            return $purchase;

        }, $value);

        if($resp != null){
            return $resp;
        }
        else
            return array();
    }
}

?>