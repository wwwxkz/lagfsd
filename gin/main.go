package main

import (
	"net/http"
	"github.com/gin-gonic/gin"

	"gin/utils"
)

func main() {
	router := gin.Default()
	router.GET("/", func(context *gin.Context) {
		utils.LoadEnv()
		utils.ConnDatabase()
		context.JSON(http.StatusOK, gin.H{"data": "Gin!"})    
	})
	router.Run(":8000")
}