<?php
function old($key, $default=null) {
    $result = $default;
    if (isset($_SESSION["form-data"])) {
        $data = $_SESSION["form-data"];
        if (is_array($data) && array_key_exists($key, $data)) {
            $result = $data[$key];
        }
    }
    return $result;
}
  
function error($key) {
    $result = null;
    if (isset($_SESSION["form-errors"])) {
        $errors = $_SESSION["form-errors"];
        if (is_array($errors) && array_key_exists($key, $errors)) {
            $result = $errors[$key];
        }
    }
    return $result;
}
  
function chosen($key, $search, $default=null) {
    $result = FALSE;
    if (isset($_SESSION["form-data"])) {
        $data = $_SESSION["form-data"];
        if (is_array($data) && array_key_exists($key, $data)) {
            $value = $data[$key];
            if (is_array($value)) {
                $result = in_array($search, $value);
            }
            else {
                $result = strcmp($value, $search) === 0;
            }
        }
    }
    else if ($default !== null) {
        if (is_array($default)) {
            $result = in_array($search, $default);
        }
        else {
            $result = strcmp($default, $search) === 0;
        }
    }
    return $result;
}

function upload($key) {
    $destination = '/uploads';
    $maxSize = 1 * 1024 * 1024; // 1 MB
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    if (!file_exists($destination)) {
        mkdir($destination);
    }
    if (!is_dir($destination)) {
        throw new Exception("Destination folder is not a directory!");
    }
    else if (!is_writable($destination)){
        throw new Exception("Destination is not writable!");
    }
    if (($_FILES[$key]['error'] !== UPLOAD_ERR_OK)) {
        $errorCode = $_FILES[$key]['error'];
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                $errorMessage = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errorMessage = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errorMessage = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errorMessage = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errorMessage = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errorMessage = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $errorMessage = "File upload stopped by extension";
                break;
            default:
                $errorMessage = "Unknown upload error";
                break;
        }
        throw new Exception($errorMessage);
    }

    $originalFileName = $_FILES[$key]["name"];
    $mimeType = $_FILES[$key]["type"];
    $fileSize = $_FILES[$key]["size"];
    $tempFileName = $_FILES[$key]["tmp_name"];

    if (!is_uploaded_file($tempFileName)) {
        throw new Exception("Illegal file upload!");
    }
    if($fileSize > $maxSize) {
        throw new Exception("Uploaded file exceeds max file size!");
    }

    $parts = explode(".", $originalFileName);
    $extension = strtolower($parts[count($parts)-1]);
    if (!in_array($extension, $allowedExtensions)) {
        throw new Exception("File type not allowed!");
    }

    $filename = strtotime(date('Y-m-d H:i:s')) . '-' . uniqid() . "." . $extension;
    $path = APP_ROOT . $destination . "/" . $filename;

    $move_status = move_uploaded_file($tempFileName, $path);
    if (!$move_status) {
        throw new Exception("File cannot be moved!");
    }

    return $filename;
}

function deleteUploaded($filename) {
    $destination = "/uploads";
    if ($filename !== "default.jpg") {
        $filepath = APP_ROOT . $destination . "/" . $filename;
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }
}
?>