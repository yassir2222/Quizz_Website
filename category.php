<?php

class Category{
    private $name;
    private $file;

    static public $MsgSuccess;
    static public $MsgError;

    public function __construct($name,$file){
        $this->name=$name;
        $this->file=$file;
    }
   

    public function InsertCategory($conn){
        $sql="INSERT INTO category(name,file) VALUES ('$this->name','$this->file')";
        if(mysqli_query($conn,$sql)){
         self::$MsgSuccess = "Category added successfully!";
        }else{
         self::$MsgError = mysqli_error($conn);
        }
    }

    static public function SellectAllCategorys($conn){
        $result=mysqli_query($conn,"SELECT * FROM category");
        return $result;
    }

    static public function SellectCategoryByname($conn,$name){
        $result=mysqli_query($conn,"SELECT * FROM category WHERE name='$name'");
    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
        return $row;
    }
    }

    public static function updateCategory($category,$conn,$name){
        //update a Etudiant of $id, with the values of $client in parameter
        $sql = "UPDATE category SET  name='$category->name' ,file='$category->file' WHERE name='$name'";
    if (mysqli_query($conn, $sql)) {
       self::$MsgSuccess = "Exame category updated successfully";
    } else {
        self ::$MsgSuccess="Error updating record: " . mysqli_error($conn);
    }
    }
    public static function updateNameCategory($name_Updat,$conn,$name){
        //update a Etudiant of $id, with the values of $client in parameter
        $sql = "UPDATE category SET  name='$name_Updat' WHERE name='$name'";
    if (mysqli_query($conn, $sql)) {
       self::$MsgSuccess = "Exame category updated successfully";
    } else {
        self::$MsgError="Error updating record: " . mysqli_error($conn);
    }
    }

    public static function deleteExamCategory($conn,$name){
    
        $sql = "DELETE FROM category WHERE name='$name'";
        if (mysqli_query($conn, $sql)) {
            self::$MsgSuccess= "Exam category deleted successfully";
            
    } else {
        self::$MsgError= "Exam deleting record: " . mysqli_error($conn);
        
    }
}
}
?>
