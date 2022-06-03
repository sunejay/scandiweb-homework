<?php
namespace Scandiweb\App\Models;

use Scandiweb\Lib\DB\Model;
/**
 * Description of Product
 *
 * @author Sune
 */
class Product extends Model
{
    private $sku;
    private $name;
    private $price;
    private $type;
    
    private $modelFields = array('sku', 'name', 'price', 'type');
    private $indexes = array('id', 'sku');
    private $tableName = 'products';
    
    public function getTableName()
    {
        return $this->tableName;
    }

    public function getModelFields()
    {
        return $this->modelFields;
    }

    public function getIndexes()
    {
        return $this->indexes;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
