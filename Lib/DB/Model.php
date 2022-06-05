<?php 
namespace Scandiweb\Lib\DB;
/**
 * Description of Model
 *
 * @author Sune
 */
abstract class Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = new Query();
    }

    abstract public function getIndexes();

    abstract public function getTableName();

    abstract public function getModelFields();
    /**
     * Insert record 
     */
    public function add()
    {
        foreach ($this->getModelFields() as $key) {
            $data[$key] = $this->{'get'.$key}();
        }
        $this->db->insert($this->getTableName(), $data);
    }
    /**
     * Update record 
     */
    public function update()
    {
        foreach ($this->getModelFields() as $key) {
            if (!is_null($this->{'get'.$key}())) {
                $data[$key] = $this->{'get'.$key}();
            }
        }
        $where = '';
        $indexes = [];
        foreach ($this->getIndexes() as $key) {
            $where .=' '.$key ." = ? &&";
            array_push($indexes, $key);
        }
        $where = rtrim($where, '&');
        $this->db->update($this->getTableName(), $data, $where, $indexes);
    }
    /**
     * Delete multiple record 
     */
    public function removeMany(string $where, array $data)
    {
        $data = "'".rtrim(implode("', '", $data), ', ')."'";
        $this->db->deleteMany($this->getTableName(), $where, $data);
    }
    /**
     * Query all record 
     */
    public function findAll($conditions=array(), $fields='*', $order='id', $limit=null, $offset='')
    {
        $where = '';
        $values = [];
        foreach ($conditions as $key => $value) {
            $where .=' '.$key.'=? '."&&";
            array_push($values, $value);
        }
        $where = rtrim($where, '&');
        $this->db->select($this->getTableName(), $where, $values, $fields, $order, $limit, $offset);
        return $this->db->resultSet();
    }
    /**
     * Query one record 
     */
    public function findOne($conditions=array(), $fields='*', $order='', $limit=null, $offset='')
    {
        $where = '';
        $values = [];
        foreach ($conditions as $key => $value) {
            $where .=' '.$key.'=? '."&&";
            array_push($values, $value);
        }
        $where = rtrim($where, '&');
        $this->db->select($this->getTableName(), $where, $values, $fields, $order, $limit, $offset);
        return $this->db->single();
    }

    public function rowCount()
    {
        return $this->db->rowCount();
    }
}
