<?php
    class FileUploader{
        //member variables
        private static $target_directory = "uploads/";
        private static $size_limit = 500000; // size given in bytes
        private $uploadOk = false;
        private $file_original_name;
        private $file_type;
        private $file_size;
        private $final_file_name;
        
        public function setOriginalName($name){
            $this->file_original_name = $name;
        }
        public function getOriginalName(){
            return $this->file_original_name;
        }
        public function setFileType($type){
            $this->file_type = $type;
        }
        public function getFileType(){
            return $this->file_type;
        }
        public function setFileSize($size){
            $this->file_size = $size;            
        }
        public function getFileSize(){
            return $this->file_size;
        }
        public function setFinalFileName($final_name){
            $this->final_file_name = $final_name;
        }
        public function getFinalFileName(){
            return $this->final_file_name;
        }
        public function setTmpName($tmp_name){
            $this->file_tmp_name = $tmp_name;
        }
        public function getTmpName(){
            return $this->file_tmp_name;
        }


        public function uploadFile($file){
            $this->setFileSize($file["size"]);
            $this->setOriginalName(FileUploader::$target_directory . basename($file["name"]));
            $this->setFileType(pathinfo($this->file_original_name,PATHINFO_EXTENSION));
            if (!getimagesize($file["tmp_name"])) {
                return false;
            }
            if ($this->fileAlreadyExists()) {
                $this->errorMessage("The file entered already exists");
                return false;   
            }
            if (!$this->fileSizeIsCorrect()) {
                $this->errorMessage("The file entered is larger than 50kb");
                return false;
            }
            if (!$this->fileTypeIsCorrect()) {
                $this->errorMessage("Incorrect file type. File types accepted are .jpg, .jpeg, png and gif");
                return false;
            }
            $this->setFinalFileName($this->file_original_name);
            $this->uploadOk = $this->moveFile($file["tmp_name"]);
            return $this->uploadOk;
        }

        public function errorMessage(string $message){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['form_errors'] = $message;
        }   

        public function fileWasSelected(){
        }
        
        public function fileAlreadyExists(){
            return file_exists($this->file_original_name);
        }        
        
        public function fileTypeIsCorrect(){
            $allowed = '/(jp?g|png|gif)/';
            return preg_match($allowed,$this->getFileType());
        }
        
        public function fileSizeIsCorrect(){
            return $this->getFileSize() <= FileUploader::$size_limit;

        }
        
        public function moveFile(string $file_tmp_name){
            return move_uploaded_file($file_tmp_name,   $this->getFinalFileName());
        }
        
        public function saveFilePathTo(){    
        }        
        
    }
?>