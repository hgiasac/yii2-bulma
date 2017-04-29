<?php
namespace bulma\grid;

class GridView extends yii\grid\GridView
{


    /**
     * @var string the default data column class if the class name is not explicitly specified when configuring a data column.
     * Defaults to 'bulma\grid\DataColumn'.
     */
    public $dataColumnClass = 'bulma\grid\DataColumn';
}
