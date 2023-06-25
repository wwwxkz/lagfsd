package utils

import (
    "fmt"
    "os"
    "gorm.io/driver/mysql"
    "gorm.io/gorm"
)

type Database struct {
    DB *gorm.DB
}

func ConnDatabase() Database {
    USER := os.Getenv("GIN_DB_USERNAME")
    PASS := os.Getenv("GIN_DB_PASSWORD")
    HOST := os.Getenv("GIN_DB_HOST")
    DBNAME := os.Getenv("GIN_DB_DATABASE")

    URL := fmt.Sprintf("%s:%s@tcp(%s)/%s?charset=utf8&parseTime=True&loc=Local", USER, PASS, 
    HOST, DBNAME)
    fmt.Println(URL)
    db, err := gorm.Open(mysql.Open(URL))

    if err != nil {
        panic("Failed to connect to database")
    }
    fmt.Println("Database connection established")
    return Database{
        DB: db,
    }

}