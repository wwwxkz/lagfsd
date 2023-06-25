FROM golang:alpine

WORKDIR /var/wwww

ADD go.mod .
ADD go.sum .

RUN go mod download
ADD . .

RUN go get github.com/githubnemo/CompileDaemon
RUN go install github.com/githubnemo/CompileDaemon

ENTRYPOINT CompileDaemon --build="go run ." --command=./main