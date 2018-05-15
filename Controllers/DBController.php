<?php

Class DBController {

    protected $_config;
    public $dbc;

    public function __construct( array $config ) {
        $this->_config = $config;
        $this->getPDOConnection();
    }


    public function __destruct() {
		$this->dbc = NULL;
	}

    private function getPDOConnection() {

        if ($this->dbc == NULL) {

            $dsn = "" .
                $this->_config['driver'] .
                ":host=" . $this->_config['host'] .
                ";dbname=" . $this->_config['dbname'];

            try {
                $this->dbc = new PDO( $dsn, $this->_config[ 'username' ], $this->_config[ 'password' ] );
            } catch( PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
    }

    public function runQuery( $sql ) {
        try {
        	$count = $this->dbc->exec($sql) or print_r($this->dbc->errorInfo());
        } catch(PDOException $e) {
        	echo __LINE__.$e->getMessage();
        }
        return $count;
    }

	public function getQuery( $sql ) {
		$stmt = $this->dbc->query( $sql );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $stmt;
	}


}