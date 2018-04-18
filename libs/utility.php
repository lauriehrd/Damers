<?php

function connectDB($host, $db, $user, $pass){
    try{
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $cnx = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
        return $cnx;
    }catch (PDOException $e){
        print "Erreur !:" .$e->getMessage() . "<br/>";
        die();
    }
};

function debug($val, $mode = 0) {
    echo '<pre style="background:#' . substr(md5(rand()), 0, 6) . '">';
    if ($mode === 1) {
        var_dump($val);
    } else {
        print_r($val);
    }
    echo "</pre>";
}

/**
 * Fonction de debug provoquant la fin du programme
 *
 * Affiche un print_r ou var_dump formaté sur une valeur ou expression
 * puis lance une instruction exit
 *
 * @since 0.1
 * @param  mixed   $val  valeur ou expression à deboguer
 * @param  integer   $mode si précisé, lance var_dump, sinon print_r
 * @return void    RAS
 */
function debugX($val, $mode = 0) {
    echo '<pre style="background:#' . substr(md5(rand()), 0, 6) . '">';
    if ($mode === 1) {
        var_dump($val);
    } else {
        print_r($val);
    }
    echo "</pre>";
    exit;
}

?>