<?php
define("LIMIT", 1);
function checkEmail($email)
{
    global $connection;
    $query = "select email from users where email = '$email'";
    return $connection->query($query)->fetch();
}

function insertUser($first_name, $last_name, $email, $password)
{
    global $connection;
    define("ROLE_ID", 2);
    $query = "insert into users (first_name, last_name, email, password, role_id) values (?,?,?,?,?)";
    $queryInsert = $connection->prepare($query);
    $password = md5($password);
    $queryInsert->execute([$first_name, $last_name, $email, $password, ROLE_ID]);
    $user_id = $connection->lastInsertId();
    insertActivity($user_id, "Registration");
}


function insertActivity($id, $action)
{
    $date = date("d/m/Y H:i:s");
    $ip = $_SERVER["REMOTE_ADDR"];
    $data = "{$id}\t{$action}\t{$date}\t{$ip}\n";
    $file = fopen('../../data/userLog.txt', 'a');
    if ($file) {
        fwrite($file, $data);
        fclose($file);
    }
}


function login($email, $password)
{
    global $connection;
    $query = "select id, role_id from users where email = ? and password =?";
    $querySelect = $connection->prepare($query);
    $querySelect->execute([$email, md5($password)]);
    $user =  $querySelect->fetch();
    insertActivity($user->id, "Login");
    return $user;
}


// # platforms 
function platforms($limit = 0)
{
    global $connection;
    $query  = "select * from platforms";
    $limit = ((int) $limit) * LIMIT;
    $offset = LIMIT;
    $queryLimit = " limit $limit, $offset";
    $baseQuery  = $query . $queryLimit;
    return $connection->query($baseQuery)->fetchAll();
}

function platoformsPagination()
{
    global $connection;
    $query  = "select count(*) as numberOfPlatforms from platforms";
    $numberOfElements = $connection->query($query)->fetch();
    $numberOfPages  = ceil($numberOfElements->numberOfPlatforms / LIMIT);
    return $numberOfPages;
}

function getPlatform($column, $value)
{
    global $connection;
    $query = "select id, name from platforms where $column  ='$value'";
    return $connection->query($query)->fetch();
}

function insertPlatform($name)
{
    global $connection;
    $query = "insert into platforms (name) values(?)";
    $insertQuery = $connection->prepare($query);
    $insertQuery->execute([$name]);
}

function softDeletePlatform($id, $status)
{
    global $connection;
    $query = "update platforms set  is_deleted=?  where id=?";
    $query_delete = $connection->prepare($query);
    $query_delete->execute([$status, $id]);
}

function getPlatformFullRow($id)
{
    global $connection;
    $query = "select * from platforms where id ='$id'";
    return $connection->query($query)->fetch();
}

function checkNamePlatform($name)
{
    $query = "select name from platforms where name = '$name'";
    return checkName($query);
}

function checkName($query)
{
    global $connection;
    return $connection->query($query)->fetch();
}

function updatePlatform($name, $id)
{
    global $connection;
    $date = date("Y-m-d H:i:s");
    $query = "update platforms set  name =?, updated_at = ? where id =?";
    $queryUpdate = $connection->prepare($query);
    $queryUpdate->execute([$name, $date, $id]);
}


// # publishers 

function getAllPublishers($limit = 0)
{
    global $connection;
    $query =  'select * from publishers';

    $limit = (int)$limit * LIMIT;
    $offset = LIMIT;
    $limitQuery = " limit $limit, $offset";
    $baseQuery = $query . $limitQuery;
    return $connection->query($baseQuery)->fetchAll();
}


function publisherPagination()
{
    global $connection;
    $query = "select count(*) as numberOfPublishers from publishers";
    $publishers  = $connection->query($query)->fetch();
    $publisherPages = ceil($publishers->numberOfPublishers / LIMIT);
    return $publisherPages;
}


function getPublisher($column, $value)
{
    global $connection;
    $query  = "select id, name from publishers where $column = '$value'";
    return $connection->query($query)->fetch();
}

function softDeletePublisher($id, $status)
{
    global $connection;
    $query = "update publishers set is_deleted = ? where id = ?";
    $queryUpdate = $connection->prepare($query);
    $queryUpdate->execute([$status, $id]);
}

function  getFullPublisherRow($id)
{
    global $connection;
    $query = "select * from publishers where id ='$id'";
    return $connection->query($query)->fetch();
}


function checkPublisherName($column, $value)
{
    global $connection;
    $query = "select id, name from publishers where $column = '$value'";
    return $connection->query($query)->fetch();
}

function insertPublisher($name)
{
    global $connection;
    $query  = 'insert into publishers (name) values(?)';
    $queryInsert = $connection->prepare($query);
    $queryInsert->execute([$name]);
}

function updatePublisher($id, $name)
{
    global $connection;
    $date = date("Y-m-d H:i:s");
    $query = 'update publishers set name =? , updated_at =? where id =?';
    $queryUpdate = $connection->prepare($query);
    $queryUpdate->execute([$name, $date, $id]);
}


// # games

function getAllGames($limit = 0)
{
    global $connection;
    $query = "select g.* , p.name as publisherName from games g join publishers p on g.publisher_id = p.id";
    $limit = ((int)$limit) * LIMIT;
    $offset = LIMIT;
    $queryLimit = " limit $limit, $offset";
    $baseQuery = $query . $queryLimit;
    return $connection->query($baseQuery)->fetchAll();
}


function gamePagination()
{
    global $connection;
    $query = 'select count(*) as numberOfGames from games';
    $gamesCount = $connection->query($query)->fetch();
    $pages = ceil($gamesCount->numberOfGames / LIMIT);
    return $pages;
}
