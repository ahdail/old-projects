<?php
     //include "resultset.inc";

    /**
     ** Esta classe emcapsula o resultado de uma consulta
     ** atravйs do mйtodo query($sql) da classe Database.
     ** @author Marlus Saraiva
     **/
     class ResultSet
     {
           var $driver;
           var $dbresult;
           //Para uso dos drivers
           var $current_row=0;
           var $sql;
           //

          /**
           ** Cria uma nova instвncia da classe.
           ** @returns ResultSet
           ** @param $rs O ResultSet especнfico do banco (ibase, mysql...)
           ** @param $driver Instвncia do driver do banco de dados (Driver_ibase, Driver_mysql...)
           **/
           function ResultSet($rs, $driver)
           {
                    $this->dbresult = $rs;
                    $this->driver = $driver;
                    $this->current_row = 0;
           }

          /**
           ** Retorna um array indexado com os valores de cada campo da consulta ou false
           ** se a consulta for vazia.
           ** @returns ResultSet
           **/
           function fetch_row()
           {
                    return $this->driver->fetch_row($this);
           }

           /**
           ** Retorna parte dos dados da condulta contendo $nlines a partir de $fline.
           ** @returns array
           ** @param $fline registro inicial da consulta
           ** @param $nlines nъmero de registros consultados
           **/
           function fetch_rows($fline, $nlines)
           {
                    return $this->driver->fetch_rows($this, $fline, $nlines);
           }

           /**
           ** Retorna um array associativo com os valores de cada campo da consulta ou false
           ** se a consulta for vazia.
           ** @returns ResultSet
           **/
           function fetch_array()
           {
                    return $this->driver->fetch_array($this);
           }

           /**
           ** Retorna parte dos dados da condulta contendo $nlines a partir de $fline.
           ** @returns array
           ** @param $fline registro inicial da consulta
           ** @param $nlines nъmero de registros consultados
           **/
           function fetch_arrays($fline, $nlines)
           {
                    return $this->driver->fetch_arrays($this, $fline, $nlines);
           }

           /**
           ** Retorna o nъmero de linhas da consulta.
           ** @returns int
           **/
           function num_rows()
           {
                    return $this->driver->num_rows($this);
           }

           /**
           ** Retorna o nъmero de campos da consulta.
           ** @returns int
           **/
           function num_fields()
           {
                    return $this->driver->num_fields($this);
           }

           /**
           ** Retorna o nome do campo.
           ** @returns string
           ** @param $index o нndice do campo na consulta
           **/
           function field_name($index)
           {
                    return $this->driver->field_name($this,$index);
           }

           /**
           ** Retorna o tamanho do campo.
           ** @returns int
           ** @param $index o нndice do campo na consulta
           **/
           function field_size($index)
           {
                    return $this->driver->field_size($this,$index);
           }

           /**
           ** Libera o ResultSet da memуria.
           ** @returns verificar
           **/
           function free()
           {
                    return $this->driver->free_result($this);
           }

           /**
           ** Posiciona o cursor do ResultSet em $pos.
           ** @returns verificar
           ** @param $pos posiзгo desejada
           **/
           function seek($pos = 0)
           {

                    return $this->driver->seek($this, $pos);
           }
     }

     /**
     ** Esta classe emcapsula o um Banco de Dados.
     ** @author Marlus Saraiva
     **/
     class Database
     {
           var $driver;
           var $conn;

           /**
           ** Cria uma nova instвncia da classe.
           ** @returns Database
           ** @param $driver Instвncia do driver do banco de dados (Driver_ibase, Driver_mysql...)
           **/
           function Database($driver)
           {
                    $this->driver = $driver;
           }

           /**
           ** Abre a conexгo com o banco.
           ** @returns verificar
           ** @param $params parвmetros de conexгo (host, user, password...)
           **/
           function connect($params = array())
           {
                    $this->conn = $this->driver->connect($params);
                    return $this->conn;
           }

           /**
           ** Executa uma consulta e retorna um ResultSet.
           ** @returns ResultSet
           ** @param $sql consulta SQL
           **/
           function query($sql)
           {
                    return $this->driver->query($sql, $this->driver);
           }

           /**
           ** Executa um comando SQL.
           ** @returns boolean
           ** @param $sql comando SQL (insert, update, delete)
           **/
           function execute($sql)
           {
                    return $this->driver->execute($sql);
           }

           /**
           ** Fecha a conexгo com o banco.
           ** @returns verificar
           **/
           function disconnect()
           {
                    return $this->driver->disconnect($this->conn);
           }
     }
?>