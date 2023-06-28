FROM openjdk:17-jdk-alpine as build
 
ARG user
ARG uid

RUN adduser -D -u $uid -h /home/$user $user
RUN mkdir -p /home/$user && \
    chown -R $user:$user /home/$user
USER $user

WORKDIR /app

COPY mvnw .
COPY .mvn .mvn
COPY pom.xml .
COPY src src

RUN ./mvnw install -DskipTests
RUN mkdir -p target/dependency && (cd target/dependency; jar -xf ../*.jar)

FROM openjdk:17-jdk-slim

ARG user
ARG uid

RUN useradd -u $uid -d /home/$user $user
RUN mkdir -p /home/$user && \
    chown -R $user:$user /home/$user
USER $user

ENTRYPOINT ["./mvnw","spring-boot:run"]