<?php

/**
 * Created by OliLogicStudios.
 * User: OlivaDevelop
 * Project: HundirLaFlota3DServer
 * File: _EntitySerialize.php
 * Date: 09/08/2017 02:48
 */
class _EntitySerialize implements Serializable {

    private $object;

    public function __construct() {
        //obtengo un array con los parámetros enviados a la función
        $params = func_get_args();
        //saco el número de parámetros que estoy recibiendo
        $num_params = func_num_args();
        //cada constructor de un número dado de parámtros tendrá un nombre de función
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array( $this, $funcion_constructor ), $params);
        } else {
            $this->__construct0();
        }
    }

    public function __construct0() {
    }

    public function __construct1($arrayValues) {
    }

    public function __construct2($arrayValues, $full = TRUE) {
    }

    public function __toString() {
        return $this->serialize();
    }

    protected function setObject($object) {
        $this->object = $object;
    }

    public function serialize() {
        try {
            return json_encode($this->object, JSON_FORCE_OBJECT | JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            throw new Exception($e . ': ' . json_last_error_msg());
        }
    }

    public function getVars() {
        return $this->object;
    }

    public function asArray() {
        return json_decode($this->serialize(), TRUE);
    }

    public function unserialize($serialized) {
        return json_decode($serialized, TRUE);
    }
}
