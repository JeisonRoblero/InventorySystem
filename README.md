# InventorySystem
Sistema de Inventarios con usuarios y compras. Los usuarios pueden registrarse con su cuenta de Google a través de OAuth.

### Página Web
[http://inventorysys.rf.gd/](http://inventorysys.rf.gd/)

Ingresar modo administrador con:
correo: admin@gmail.com
contraseña: 123

### Link de Presentación
https://prezi.com/view/OPXpzOGA9v6CpDD5anrO/

### Índice
- [Requisitos](#requisitos)
- [Pasos para Instalar](#pasos-para-instalar)
- [Capturas de Pantalla](#capturas-de-pantalla)
- [Testing: Capturas de Pantalla de Pruebas en Compras](#testing-capturas-de-pantalla-de-pruebas-en-compras)

### Requisitos
Para instalar y ejecutar este sistema, se necesita tener instalados los siguientes componentes:
- **PHP 7**
- **XAMPP**
- **MySQL**
- **Composer**
- **Git**

### Pasos para Instalar
1. **Navegar al directorio de htdocs de XAMPP:**
   ```bash
   cd C:\xampp\htdocs
   
2. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/JeisonRoblero/InventorySystem.git

3. **Navegar al directorio del proyecto (en su API):**
   ```bash
   cd InventorySystem\api

4. **Instalar las dependencias con Composer:**
   ```bash
   cd composer install

5. **Configurar la base de datos:**
   - Crear una nueva base de datos en MySQL.
   - Importar el archivo SQL de configuración.
  
6. **Configurar las credenciales de la base de datos y de Google OAuth:**
   - Crear un archivo .env dentro de la carpeta api/ y agregar las siguientes claves:
   
   ```bash
   GOOGLE_OAUTH_CLIENT_ID=XXXXX
   GOOGLE_OAUTH_CLIENT_SECRET=XXXXX 
   DB_USERNAME=XXXXX 
   DB_PASSWORD=XXXXX

7. **Iniciar el servidor:**
   - Ejecutar XAMPP y asegurarse de que el módulo de Apache y MySQL estén corriendo.
  
8. **Acceder a la aplicación:**
   - Se puede acceder mediante un navegador ingresando a ```http://localhost/InventorySystem/``` (o la ruta correspondiente según la configuración del servidor local).

## Capturas de Pantalla
<div style="display: flex; flex-wrap: wrap;">
  <img src="https://github.com/user-attachments/assets/d78a5f00-1f79-49a9-a436-80f59fc29081" style="width: 350px; height: auto; margin: 5px;">
  <img src="https://github.com/user-attachments/assets/56fede7b-ffa7-48d3-8231-3e4cb24d2f56" style="width: 350px; height: auto; margin: 5px;">
  <img src="https://github.com/user-attachments/assets/d04a463a-009b-482f-a5dd-4a922e61de35" style="width: 350px; height: auto; margin: 5px;">
  <img src="https://github.com/user-attachments/assets/2fdf9819-0934-4e43-8c75-d7324620db60" style="width: 350px; height: auto; margin: 5px;">
  <img src="https://github.com/user-attachments/assets/11d29ee7-8996-4d8e-b3bb-b86412053026" style="width: 350px; height: auto; margin: 5px;">
  <img src="https://github.com/user-attachments/assets/c2ab8f27-84c2-4fa2-beef-2918fc5efdab" style="width: 350px; height: auto; margin: 5px;">
  <img src="https://github.com/user-attachments/assets/bf8e1a49-07c8-4bde-8443-e19bc4571aa4" style="width: 350px; height: auto; margin: 5px;">
</div>

## Testing: Capturas de Pantalla de Pruebas en Compras
### Cuando las pruebas se ejecutan correctamente
<img src="https://github.com/user-attachments/assets/7f00164a-bc24-4726-ade5-5b5009ef1535" style="width: 100%; height: auto;">

### Cuando las pruebas se ejecutan con errores
Prueba de fallo en la creación de compras  
<img src="https://github.com/user-attachments/assets/e6a3c024-712f-4371-911b-9a52aff64454" style="width: 100%; height: auto;">

Prueba de fallo al obtener, crear, actualizar y eliminar compras  
<img src="https://github.com/user-attachments/assets/441de428-ca0b-4cfb-b664-5b54250f5753" style="width: 100%; height: auto;">
<img src="https://github.com/user-attachments/assets/3e6b0030-8155-4b98-b90b-f9205907ae6e" style="width: 100%; height: auto;">
