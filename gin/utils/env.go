package utils

import (
    "log"
    "github.com/joho/godotenv"
)

func LoadEnv() {
    err := godotenv.Load(".env")
    if err != nil {
        log.Fatalf("Unable to load .env file")
    }
}
