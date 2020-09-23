
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESTfull para testing</title>
    <link href="/bootstrap.css" rel="stylesheet"/>
    <link href="/layout-front.css" rel="stylesheet"/>
</head>
<body>
    <div class="container" id="container">
        <div class="row" id="header">
    </div>
    <div class="row" id="content">
        <div class="col" id="cabecera">
            <div class="row contenedor">
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <h3 class="text-left">
                        <span class="lb-title">Desarrollo de servicios web REST “inseguros” para auto-aprendizaje en explotación de vulnerabilidades</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Este sistema contiene unos pocos endpoints para análisis de vulnerabilidades, 
                las vulnerabilidades son insertadas de manera aleatoria en los mismos.  Se puede cargar una nueva
                distribución de vulnerabilidades con el siguiente comando:
            </p>
            <p class="bold">docker-compose exec php reset.php </p>
            <?php if(config('app.auth')): ?>
            <!-- Sistema con login -->
            <h3 class="title-section">Autenticación</h3>
            <p>Actualmente esta habilitada la autenticacion por JWT, los usuarios iniciales son:</p>
            <ul>
                <li>admin@lumen.com</li>
                <li>usera@lumen.com</li>
                <li>userb@lumen.com</li>
            </ul>
            <h4><span class="bold">POST</span> /auth/login</h4>
            <p>Obtiene un token JWT para uso en los endpoinst que solicitan autorización, requiere los parámetros
                <span class="bold">email</span> y <span class="bold">password</span>.  El token puede usarse en el header Bearer o dentro del 
                parámetro <span class="bold">token</span>.</p>
            <h4><span class="bold">POST</span> /auth/logout</h4>
            <p>Termina la autorización del usuario.</p>
            <h4><span class="bold">POST</span> /auth/me</h4>
            <p>Devuelve la información del usuario activo.</p>
            <?php endif; ?>
            <?php if(config('app.nivel_global') < 8): ?>
            <!-- Visualización de endpoints -->
            <h3 class="title-section">Lista de endpoints</h3>
            <h4><span class="bold">GET</span> /articulo</h4>
            <p>Lista los artículos presentes en base de datos, puede aceptar un parámetro adicional 
                <span class="bold">filtro</span> para efectuar una búsqueda dentro del listado.</p>
            <h4><span class="bold">GET</span> /articulo/{id}</h4>
            <p>Consulta la información de un artículo identificado por el parámetro "id" de tipo numérico.</p>
            <h4><span class="bold">POST</span> /articulo</h4>
            <p>Este endpoint es para crear un nuevo artículo, debe suministrarse los parámetros
                <span class="bold">nombre</span> y <span class="bold">valor</span> de tipo cadena de texto
                y decimal respectivamente.</p>
            <h4><span class="bold">PUT</span> /articulo/{id}</h4>
            <p>Actualiza la información de un artiículo referenciado por "id", con alguno de los parámetros 
                usados en el endpoint de crear.</p>
            <h4><span class="bold">DELETE</span> /articulo/{id}</h4>
            <p>Elimina el artículo referenciado por "id".</p>
            <h4><span class="bold">POST</span> /articulo/upload/{id}</h4>
            <p>Actualiza el campo imagen del artiículo referenciado por "id", requiere los parámetros
                <span class="bold">archivo</span> y <span class="bold">nombre</span>. 
                El valor de archivo es el contenido de un archivo binario codificado en base64 en el formato
                estándar {mime-type};base64,{data-base64}, el archivo procesado puede verse en la url regresada como respuesta.</p>
            <h4><span class="bold">POST</span> /articulo/{id}/{usuario}</h4>
            <p>Método para cambiar la pertenecia de un artículo a otro usuario, los parámetros "id" y "usuario"
                son numéricos.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row" id="footer">
        <div class="col">
            <div class="row">
                <div class="col franja">Sistema: <?php echo $version ?></div>
            </div>
        </div>
    </div>
</body>
</html>
