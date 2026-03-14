<?php

namespace Controllers;

use Error;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
use Models\Images;
use Models\Projects;

class ImagesController {

    private static $folder = __DIR__ . "/../public/build/img/projects";

    // Se manda a llamar con pasando el arreglo $_FILEs["galery"];
    public static function createMultiImages (array $files, int $projectId, string $role) : void {
        // Normalizar el arreglo de imagenes
        $normFiles = self::normalizeFileArray($files);
        // Iterar sobre el arreglo Files la función createSingleImage()
        foreach ($normFiles as $file) {
            self::createSingleImage($file, $projectId, $role);
        }
    }
    
    // Se manda a llamar con pasando el arreglo $_FILEs["thumbnail"];
    public static function createSingleImage (array $file, int $projectId, string $role) : void {
        // Crear un objeto nuevo de Intervention\Image\Manager
        $manager = new Image(new Driver);
        // Validar que no existen errores en la subida del archivo
        self::validateUploadError($file["error"]);
        // Validar que es un tipo correcto
        self::validateMimeType($file["type"]);
        // Validar que la carpeta destino exista
        self::validateFolderExist(self::$folder);
        // Crear un nombre base unico
        $baseName = md5(uniqid(rand(), true));
        // Leer y almacenar la imagen PNG en carpeta
        $image = $manager->read($file["tmp_name"])->contain(800,800)->encodeByExtension("jpeg", 80); 
        $image->save(self::$folder . "/{$baseName}.jpeg");
        // Leer y almacenar la imagen WEBP en carpeta
        $image = $manager->read($file["tmp_name"])->contain(800,800)->encodeByExtension("webp", 80); 
        $image->save(self::$folder . "/{$baseName}.webp");
        // Almacenar el nombre base de la imagen en la base de datos + ID de proyecto y rol
        $projectImage = new Images([
            "projectId" => $projectId,
            "name" => $baseName,
            "role" => $role
        ]);
        $projectImage->save();
    }

    public static function deleteImageEntity () {
        $imageId = filter_var((int) $_GET["id"], FILTER_VALIDATE_INT);
        $projectId = filter_var((int) $_GET["projId"], FILTER_VALIDATE_INT);

        $image = Images::find($imageId);

        if((int) $image->projectId === $projectId) {
            self::deleteSingleImage($image);
            $image->delete();
        }

        header("Location: /admin/projects/edit?id=" . $projectId);
        exit;
    }

    private static function deleteSingleImage(Images $img) {
        $name = $img->name;
        $jpegPath = __DIR__ . "/../public/build/img/projects/" . $name . ".jpeg";
        $webpPath = __DIR__ . "/../public/build/img/projects/" . $name . ".webp";

        unlink($jpegPath);
        unlink($webpPath);
    }

    private static function validateUploadError(int $fileError) : void {
        if($fileError !== 0) {
            throw new \Exception("Error al subir el archivo");
        }
    }

    private static function validateMimeType(string $fileType) : void {
        $allowed = ["image/jpeg", "image/png"];
        
        if(!in_array($fileType, $allowed)) {
            throw new \Exception("Tipo de archivo no soportado");
        }
    } 

    private static function validateFolderExist (string $path) : void {
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }

    private static function normalizeFileArray(array $files) : array {
        $normalized_FILES = [];
        
        foreach($files["name"] as $index => $name) {
            $normalized_FILES[] = [
                "name"     => $files["name"][$index],
                "type"     => $files["type"][$index],
                "tmp_name" => $files["tmp_name"][$index],
                "error"    => $files["error"][$index],
                "size"     => $files["size"][$index]
            ]; 
        }
        return $normalized_FILES;
    }
}