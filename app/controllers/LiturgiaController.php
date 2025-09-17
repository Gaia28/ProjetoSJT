<?php
use App\Models\ApiModel;
require_once dirname(__DIR__) . '/models/ApiModel.php';

class LiturgiaController {

    public function mostrarLiturgia() {
        $apiModel = new ApiModel();
        $liturgia = $apiModel->getLiturgia();
        return require dirname(__DIR__) . '/views/Liturgia.php';
    }
}   