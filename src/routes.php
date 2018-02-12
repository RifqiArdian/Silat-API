<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Http\Controllers\PelatihControllers;

require 'vendor/autoload.php';
require 'libs/NotOrm.php';

function getConnect(){
    require_once 'include/dbHandler.php';
    $db = new dbHandler();
    return $db;
}

// Routes
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


// get pelatih
$app->get("/pelatih/", function (Request $request, Response $response){
    $sql = "SELECT * FROM pelatih";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});


// show pelatih
$app->get("/pelatih/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM pelatih WHERE id_pelatih=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// post pelatih
$app->post("/pelatih/", function (Request $request, Response $response){
    $new_pelatih = $request->getParsedBody();
    $sql = "INSERT INTO pelatih (nama_pelatih, aliran, deskripsi, no_hp, email, alamat, kota, foto_profil, hari, waktu, biaya) VALUE (:nama_pelatih, :aliran, :deskripsi, :no_hp, :email,:alamat, :kota, :foto_profil,:hari, :waktu, :biaya)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":nama_pelatih" => $new_pelatih["nama_pelatih"],
        ":aliran" => $new_pelatih["aliran"],
        ":deskripsi" => $new_pelatih["deskripsi"],
        ":no_hp" => $new_pelatih["no_hp"],
        ":email" => $new_pelatih["email"],
        ":alamat" => $new_pelatih["alamat"],
        ":kota" => $new_pelatih["kota"],
        ":foto_profil" => $new_pelatih["foto_profil"],
        ":hari" => $new_pelatih["hari"],
        ":waktu" => $new_pelatih["waktu"],
        ":biaya" => $new_pelatih["biaya"]
    ];
    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

// ubah pelatih
$app->put("/pelatih/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_pelatih = $request->getParsedBody();
    $sql = "UPDATE pelatih SET nama_pelatih=:nama_pelatih, aliran=:aliran, deskripsi=:deskripsi, no_hp=:no_hp, email=:email, alamat=:alamat, kota=:kota, foto_profil=:foto_profil, hari=:hari, waktu=:waktu, biaya=:biaya WHERE id_pelatih=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":nama_pelatih" => $new_pelatih["nama_pelatih"],
        ":aliran" => $new_pelatih["aliran"],
        ":deskripsi" => $new_pelatih["deskripsi"],
        ":no_hp" => $new_pelatih["no_hp"],
        ":email" => $new_pelatih["email"],
        ":alamat" => $new_pelatih["alamat"],
        ":kota" => $new_pelatih["kota"],
        ":foto_profil" => $new_pelatih["foto_profil"],
        ":hari" => $new_pelatih["hari"],
        ":waktu" => $new_pelatih["waktu"],
        ":biaya" => $new_pelatih["biaya"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

// hapus pelatih
$app->delete("/pelatih/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM pelatih WHERE id_pelatih=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


// get sanggar
$app->get("/sanggar/", function (Request $request, Response $response){
    $sql = "SELECT * FROM sanggar";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// show sanggar
$app->get("/sanggar/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM sanggar WHERE id_sanggar=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

// post sanggar
$app->post("/sanggar/", function (Request $request, Response $response){

    $new_sanggar = $request->getParsedBody();

    $sql = "INSERT INTO sanggar (nama_sanggar, aliran, deskripsi, pelatih, no_hp, email, alamat, kota, website, latitude, longitude, gambar, hari, waktu, biaya) VALUE (:nama_sanggar, :aliran, :deskripsi, :pelatih, :no_hp, :email, :alamat, :kota, :website, :latitude, :longitude, :gambar, :hari, :waktu, :biaya)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":nama_sanggar" => $new_sanggar["nama_sanggar"],
        ":aliran" => $new_sanggar["aliran"],
        ":deskripsi" => $new_sanggar["deskripsi"],
        ":pelatih" => $new_sanggar["pelatih"],
        ":no_hp" => $new_sanggar["no_hp"],
        ":email" => $new_sanggar["email"],
        ":alamat" => $new_sanggar["alamat"],
        ":kota" => $new_sanggar["kota"],
        ":website" => $new_sanggar["website"],
        ":latitude" => $new_sanggar["latitude"],
        ":longitude" => $new_sanggar["longitude"],
        ":gambar" => $new_sanggar["gambar"],
        ":hari" => $new_sanggar["hari"],
        ":waktu" => $new_sanggar["waktu"],
        ":biaya" => $new_sanggar["biaya"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

// hapus sanggar
$app->delete("/sanggar/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM sanggar WHERE id_sanggar=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

// ubah sanggar
$app->put("/sanggar/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_sanggar = $request->getParsedBody();
    $sql = "UPDATE sanggar SET nama_sanggar=:nama_sanggar, aliran=:aliran, deskripsi=:deskripsi, pelatih=:pelatih, no_hp=:no_hp, email=:email, alamat=:alamat, kota=:kota, website=:website, latitude=:latitude, longitude=:longitude, gambar=:gambar, hari=:hari, waktu=:waktu, biaya=:biaya WHERE id_sanggar=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":nama_sanggar" => $new_sanggar["nama_sanggar"],
        ":aliran" => $new_sanggar["aliran"],
        ":deskripsi" => $new_sanggar["deskripsi"],
        ":pelatih" => $new_sanggar["pelatih"],
        ":no_hp" => $new_sanggar["no_hp"],
        ":email" => $new_sanggar["email"],
        ":alamat" => $new_sanggar["alamat"],
        ":kota" => $new_sanggar["kota"],
        ":website" => $new_sanggar["website"],
        ":latitude" => $new_sanggar["latitude"],
        ":longitude" => $new_sanggar["longitude"],
        ":gambar" => $new_sanggar["gambar"],
        ":hari" => $new_sanggar["hari"],
        ":waktu" => $new_sanggar["waktu"],
        ":biaya" => $new_sanggar["biaya"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


// post image pelatih
$app->post('/pelatih/foto_profil/{id}', function(Request $request, Response $response, $args) {
    
    $uploadedFiles = $request->getUploadedFiles();
    
    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['foto_profil'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        
        // ubah nama file dengan id
        $filename = sprintf('%s.%0.8s', $args["id"], $extension);
        
        $directory = $this->get('settings')['upload_directory_pelatih'];
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        // simpan nama file ke database
        $sql = "UPDATE pelatih SET foto_profil=:foto_profil WHERE id_pelatih=:id";
        $stmt = $this->db->prepare($sql);
        $params = [
            ":id" => $args["id"],
            ":foto_profil" => $filename
        ];
        
        if($stmt->execute($params)){
            // ambil base url dan gabungkan dengan file name untuk membentuk URL file
            $url = $request->getUri()->getBaseUrl()."/uploads/pelatih/".$filename;
            return $response->withJson(["status" => "success", "data" => $url], 200);
        }
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
});

// post image sanggar
$app->post('/sanggar/gambar/{id}', function(Request $request, Response $response, $args) {
    
    $uploadedFiles = $request->getUploadedFiles();
    
    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['gambar'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        
        // ubah nama file dengan id
        $filename = sprintf('%s.%0.8s', $args["id"], $extension);
        
        $directory = $this->get('settings')['upload_directory_sanggar'];
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        // simpan nama file ke database
        $sql = "UPDATE sanggar SET gambar=:gambar WHERE id_sanggar=:id";
        $stmt = $this->db->prepare($sql);
        $params = [
            ":id" => $args["id"],
            ":gambar" => $filename
        ];
        
        if($stmt->execute($params)){
            // ambil base url dan gabungkan dengan file name untuk membentuk URL file
            $url = $request->getUri()->getBaseUrl()."/uploads/sanggar/".$filename;
            return $response->withJson(["status" => "success", "data" => $url], 200);
        }
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
});

$app->post('/login', function($req, $res, $arg) use($app){
    $db = getConnect();
    $user = $req->getParam('username');
    $pass = md5($req->getParam('password'));
    if($result = $db->verifyLogin($user, $pass)){
        echo json_encode($result);
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Data tidak ditemukan'));
    }
});

$app->get('/users/{auth}', function($req, $res, $arg) use($app){
    $db = getConnect();
    if(isset($arg['auth'])){
        if($db->validate($arg['auth'])){
            $result = $db->getUsers();
            echo json_encode($result);
        }else{
            echo json_encode(array(
                'status'    => false,
                'message'   => 'Api key belum terdaftar'));
        }
    }
});

$app->get('/user/{id}/{auth}', function($req, $res, $arg) use($app){
    $db = getConnect();
    if(isset($arg['auth'])){
        if($db->validate($arg['auth'])){
            if($db->getUserById($arg['id'])){
                $result = $db->getUserById($arg['id']);
                echo json_encode($result);
            }
        }else{
            echo json_encode(array(
                'status'    => false,
                'message'   => 'Api key belum terdaftar'));
        }
    }
});

//Register user
$app->post('/user', function($req, $res, $arg) use($app){
    $db = getConnect(); 
    $data = $req->getParams();
    if($result = $db->createUser($data))
        echo json_encode(array('status' => $result));
    else
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Gagal menambahkan data'));
});

$app->put('/user/{id}/{auth}', function($req, $res, $arg) use($app){
    $db = getConnect();
    if(isset($arg['auth'])){
        if($db->validate($arg['auth'])){    
            $data = $req->getParams();
            $result = $db->updateUser($arg['id'], $data);
            echo json_encode(array(
                'status'    => $result));
        }else{
            echo json_encode(array(
                'status'    => false,
                'message'   => 'Api key belum terdaftar'));
        }
    }
});

$app->delete('/user/{id}/{auth}', function($req, $res, $arg) use($app){
    $db = getConnect();
    if(isset($arg['auth'])){
        if($db->validate($arg['auth'])){
            if(isset($arg['id'])){
                $delete = $db->deleteUser($arg['id']);
                echo json_encode(array(
                    'status'    => $delete));
            }
        }else{
            echo json_encode(array(
                'status'    => false,
                'message'   => 'Api key belum terdaftar'));
        }
    }
});