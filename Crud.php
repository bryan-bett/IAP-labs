<?php
    interface Crud{
        /*methods to be implemented by any class that 
        implements this interface*/
        public function save();
        public function readAll();
        public function readUnique();
        public function search();
        public function update();
        public function removeOne();
        public function removeAll();

        //these methods added for lab 2
        public function validateForm();
        public function createFormErrorSessions();
    }


?>