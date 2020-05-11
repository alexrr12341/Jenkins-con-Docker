## Índice

1. [Introducción](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#1-introducción)
   - [Descripción del proyecto](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#11-descripci%C3%B3n-del-proyecto)
   - [Escenario](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#12-escenario)
2. [¿Qué es Jenkins?](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#2-qu%C3%A9-es-jenkins)
3. [¿Qué es Docker?](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#3-qu%C3%A9-es-docker)
   - [Contenedores](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#31-contenedores)
   - [Docker](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#32-docker)
4. [Instalaciones](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#33-instalaciones)7
   - [Docker](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#32-docker)
   - [Jenkins]((https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#35-jenkins)
      - [Via Docker](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#32-docker)
x. [Webgrafía]()
## 1. Introducción

### 1.1. Descripción del proyecto

El objetivo del proyecto es la creación de distintos Jenkinsfiles para controlar diversos test que realizaremos a la hora de la creación de imagenes en Docker.
Si esos test son pasados, se procederá a subir la imagen a Dockerhub y será llevado a producción.

Primero la máquina desarrollo será la que haga actualizaciones a nuestra aplicación en github, en ese repositorio tendremos un Jenkinsfile que ejecutará una serie de procesos para que se pueda subir la aplicación a la máquina de producción.

La máquina jenkins será la que tenga alojada jenkins y actuará como servidor principal y la que subirá la imagen a DockerHub y si pasa todos los test será desplegada.

### 1.2. Escenario

![](./escenario.png)

* Jenkins (172.22.201.144): Debian Buster 10.3, 2 Cpus, 4 GB RAM, 20 GB espacio
* Desarrollo (172.22.200.55): Debian Buster 10.3, 2 Cpus, 1 GB RAM, 10 GB espacio

## 2. ¿Qué es Jenkins?
**Jenkins** es un servidor de automatización open source escrito en **Java**. Está basado en el proyecto Hudson y es, dependiendo de la visión, **un fork del proyecto o simplemente un cambio de nombre.**

Jenkins ayuda en la automatización de parte del proceso de desarrollo de software mediante **integración continua** y facilita ciertos aspectos de la **entrega continua**. Admite herramientas de control de versiones como **CVS, Subversion, Git, Mercurial, Perforce y Clearcase** y puede ejecutar proyectos basados en **Apache Ant y Apache Maven**, así como secuencias de comandos de consola y programas por lotes de Windows. El desarrollador principal es **Kohsuke Kawaguchi**. Publicado bajo licencia **MIT**, Jenkins es **software libre**.​ 

## 3. ¿Qué es Docker?

### 3.1. Contenedores
Los contenedores le ofrecen un modo estándar de **empaquetar el código, las configuraciones y las dependencias de su aplicación en un único objeto**. Los contenedores **comparten un sistema operativo** instalado en el servidor, y se **ejecutan como procesos aislados de los recursos**, lo que garantiza **implementaciones rápidas, fiables y consistentes** sea cual sea el entorno en el que se realizan. 


### 3.2. Docker
Docker es un proyecto de **código abierto** que **automatiza el despliegue de aplicaciones** dentro de **contenedores de software**, proporcionando una capa adicional de abstracción y automatización de virtualización de aplicaciones en múltiples sistemas operativos. Docker utiliza características de aislamiento de recursos del kernel Linux, tales como **cgroups** y **espacios de nombres** (namespaces) para permitir que "contenedores" independientes se **ejecuten dentro de una sola instancia de Linux**, evitando la **sobrecarga** de iniciar y mantener máquinas virtuales.

## 4. Instalaciones

### 4.1. Docker
En Debian 10 (Buster) implementaron en la paquetería la instalación de Docker mediante apt, entonces simplemente para instalarlo deberiamos hacer:
```bash
apt install docker.io
```

Esta instalación lo haremos en ambas máquinas.


### 4.2. Jenkins



## x. Webgrafía

[Instalación de Jenkins](https://www.jenkins.io/doc/book/installing/)
