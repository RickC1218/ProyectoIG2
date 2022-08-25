<?php
class DB
{
    private $dbHost     = "bmedwpkvqgclxvayszaa-mysql.services.clever-cloud.com";
    private $dbUsername = "u4njwbpubmoozhpo";
    private $dbPassword = "urZrypNkE3L25QF0n9jx";
    private $dbName     = "bmedwpkvqgclxvayszaa";

    public function __construct()
    {
        // Connect to the database
        $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
        if ($conn->connect_error) {
            die("Failed to connect with MySQL: " . $conn->connect_error);
        } else {
            //echo 'Conexión exitosa';
            $this->db = $conn;
        }
    }

    function getRows($table, $conditions = array())
    {
        $sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $table;

        if (array_key_exists("inner_join", $conditions)) {
            $sql .= $conditions['inner_join'];
        }
        if (array_key_exists("where", $conditions)) {
            $sql .= ' WHERE ' . $conditions['where'];
        }
        if (array_key_exists("union", $conditions)) {
            $sql .= ' UNION ' . $conditions['union'];
        }

        $result = $this->db->query($sql);

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        } else {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        }
        return !empty($data) ? $data : false;
    }

    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table, $conditions, $data)
    {
        if (!empty($data) && is_array($data)) {
            if (array_key_exists("columns", $conditions)) {
                $query = "INSERT INTO " . $table . " (" . $conditions['columns'] . ")";
            } else {
                $query = "INSERT INTO " . $table;
            }
            $values = '';
            $array_aux = strval($data['ids_subtsnack']);
            $array_ids = explode(",", $array_aux);

            for ($i = 0; $i < count($array_ids); $i++) {
                $j = 0;
                foreach ($data as $x => $val) {
                    if ($x == 'ids_subtsnack') {
                        if ($array_ids[$i] == 'NULL') { // enviar valor del campo como NULL
                            $values .= ", " . $array_ids[$i] . "";
                        } else {
                            $values .= ", '" . (int)$array_ids[$i] . "'";
                        }
                    } else {
                        $pre = ($j > 0) ? ', ' : '';
                        $values  .= $pre . "'" . $val . "'";
                        $j++;
                    }
                }
                $query .= " VALUES (" . $values . ")";
                echo $query;
                $insert = $this->db->query($query);
                return ($insert != FALSE) ? TRUE : FALSE;
            }
        } else {
            return false;
        }
    }

    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table, $data, $conditions)
    {
        if (!empty($data) && is_array($data)) {
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if (!array_key_exists('modified', $data)) {
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $colvalSet .= $pre . $key . "='" . $val . "'";
                $i++;
            }
            if (!empty($conditions) && is_array($conditions)) {
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach ($conditions as $key => $value) {
                    $pre = ($i > 0) ? ' AND ' : '';
                    $whereSql .= $pre . $key . " = '" . $value . "'";
                    $i++;
                }
            }
            $query = "UPDATE " . $table . " SET " . $colvalSet . $whereSql;
            $update = $this->db->query($query);
            return $update ? $this->db->affected_rows : false;
        } else {
            return false;
        }
    }

    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($table, $conditions)
    {
        $whereSql = '';
        if (!empty($conditions) && is_array($conditions)) {
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach ($conditions as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $whereSql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }
        $query = "DELETE FROM " . $table . $whereSql;
        $delete = $this->db->query($query);
        return $delete ? true : false;
    }
}
