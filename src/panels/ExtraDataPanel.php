<?php

namespace bedezign\yii2\audit\panels;

use Yii;
use bedezign\yii2\audit\components\panels\DataStoragePanel;
use bedezign\yii2\audit\src\components\panels\BootstrapInterface;
use yii\data\ArrayDataProvider;
use yii\grid\GridViewAsset;

/**
 * ExtraDataPanel
 * @package bedezign\yii2\audit\panels
 */
class ExtraDataPanel extends DataStoragePanel
{
    public function init()
    {
        parent::init();
        $this->module->registerFunction('data', [$this, 'trackData']);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return Yii::t('audit', 'Extra');
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->data) . ')</small>';
    }

    /**
     * @param $data
     */
    public function trackData($type, $data)
    {
        $this->module->getEntry(true);
        if (!is_array($this->data))
            $this->data = [];

        $this->data[] = ['type' => $type, 'data' => $data];
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $dataProvider = new ArrayDataProvider();
        $dataProvider->allModels = $this->data;

        return Yii::$app->view->render('panels/extra/detail', [
            'panel'        => $this,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

}