## Índice

1. [Introducción](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#1-introducción)
   - [Descripción del proyecto](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#11-descripci%C3%B3n-del-proyecto)
   - [Escenario](https://github.com/alexrr12341/Jenkins-con-Docker/blob/master/Proyecto.md#12-escenario)
## 1. Introducción

### 1.1. Descripción del proyecto

El objetivo del proyecto es la creación de distintos Jenkinsfiles para controlar diversos test que realizaremos a la hora de la creación de imagenes en Docker.
Si esos test son pasados, se procederá a subir la imagen a Dockerhub y será llevado a producción.

Primero la máquina desarrollo será la que haga actualizaciones a nuestra aplicación en github, en ese repositorio tendremos un Jenkinsfile que ejecutará una serie de procesos para que se pueda subir la aplicación a la máquina de producción.

La máquina jenkins será la que tenga alojada jenkins y actuará como servidor principal y la que subirá la imagen a DockerHub y si pasa todos los test será desplegada.

### 1.2. Escenario

![](./escenario.png)
