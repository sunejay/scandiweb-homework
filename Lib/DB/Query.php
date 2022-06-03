<?php 
namespace Scandiweb\Lib\DB;

/**
 * Description of Query
 *
 * @author Sune
 */
class Query 
{    
    private $statement;
    private $result;
    private $dbHandler;

    public function __construct()
    {
        $dbConn = new Database();
        $this->dbHandler = $dbConn->getDbHandler();
    }

    /**
     * Prepares and  return statement
     */
    public function prepare($query)
    {
        $this->statement = $this->dbHandler->prepare($query);
    }

    /**
     * Binds the values of the parameters in the statement
     */
    public function bindParam(array $values)
    {
        $type = '';
        foreach ($values as $value) {
            switch (true) {
                case is_int($value):
                    $type .= 'i';
                    break;
                case is_double($value):
                    $type .= 'd';
                    break;
                case is_string($value):
                    $type .= 's';
                    break;
                default:
                    $type .= 'b';
                    break;
            }
        }
        $this->statement->bind_param($type, ...$values);
    }
    /**
     * Execute the statement
     */
    public function execute()
    {
        $this->statement->execute();
    }
    /**
     * Get result the statement
     */
    public function getResult()
    {
        $this->result = $this->statement->get_result();
    }
    /**
     * Select data
     */
    public function select($table, $where='', $values=[], $fields='*', $order='', $limit=null, $offset='')
    {
        $query = "SELECT $fields FROM $table "
            .($where ? " WHERE $where " : '')
            .($limit ? " LIMIT $limit " : '')
            .(($offset && $limit ? " OFFSET $offset " : ''))
            .($order ? " ORDER BY $order DESC" : '');
        $this->prepare($query);
        if (!empty($values)) $this->bindParam($values);
        $this->execute();
        $this->getResult();
    }
    /**
     * Insert data
     */
    public function insert($table, $data)
    {
        ksort($data);
        $fieldNames = implode(',', array_keys($data));
        $fieldValues = rtrim(str_repeat('?, ', count($data)), ', ');
        $query = "INSERT INTO $table ($fieldNames) VALUES($fieldValues)";
        $this->prepare($query);
        $this->bindParam(array_values($data));
        $this->execute();
    }
    /**
     * Update data
     */
    public function update($table, array $data, $where='', $indexes=[])
    {
        ksort($data);
        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .="$key = ?,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $query = "UPDATE $table SET $fieldDetails ".($where ? 'WHERE '.$where : '');
        $this->prepare($query);
        $this->bindParam(array_merge(array_values($data), $indexes)); 
        $this->execute();
    }
    /**
     * Delete many data
     */
    public function deleteMany($table, $where, $data)
    {
        $query = "DELETE FROM $table WHERE $where IN ($data)";
        $this->prepare($query);
        $this->execute();
    }
    /**
     * Return result set as associative array
     */
    public function resultSet()
    {
        return $this->result; 
    }
    /**
     * Return single associative array
     */
    public function single()
    {
        $this->execute();
        return $this->result->fetch_assoc();
    }
    /**
     * Return result set as object
     */
    public function singleObj()
    {
        return $this->result->fetch_object();
    }
    /**
     * Return row count
     */
    public function rowCount()
    {
        return $this->result->num_rows;
    }
}
