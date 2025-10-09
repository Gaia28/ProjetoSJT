<?php
use App\Models\ApiModel;
require_once dirname(__DIR__) . '/models/ApiModel.php';

class LiturgiaController {

     public function getLiturgiaData() {
        require_once dirname(__DIR__) . '/models/ApiModel.php';
        $apiModel = new ApiModel();
        return $apiModel->getLiturgia();
    }

    public function mostrarLiturgia() {
        $liturgia = $this->getLiturgiaData();
        require dirname(__DIR__) . '/views/Liturgia.php';
    }
}