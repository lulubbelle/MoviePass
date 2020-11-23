<?php

namespace Models;

class Ticket{

    private $id;
    private $purchaseId;
    private $qrFileName;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPurchaseId()
    {
        return $this->purchaseId;
    }

    public function setPurchaseId($purchaseId)
    {
        $this->purchaseId = $purchaseId;

        return $this;
    }

    public function getQrFileName()
    {
        return $this->qrFileName;
    }

    public function setQrFileName($qrFileName)
    {
        $this->qrFileName = $qrFileName;

        return $this;
    }

    
    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $purchase = new Ticket();
            $purchase->setId($p['ID']);
            $purchase->setPurchaseId($p['PURCHASE_ID']);
            $purchase->setQrFileName($p['QR_FILE_NAME']);
            
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