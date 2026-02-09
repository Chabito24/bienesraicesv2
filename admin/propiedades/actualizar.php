<?php
    // ======================
    // 1) Validación del ID
    // ======================
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
        exit;
    }

    // ======================
    // 2) BD
    // ======================
    require '../../includes/config/database.php';
    $db = conectarDB();

    // ======================
    // 3) Obtener propiedad actual
    // ======================
    $stmt = $db->prepare("SELECT * FROM propiedades WHERE id = ? LIMIT 1");
    if (!$stmt) {
        die("Error prepare SELECT: " . $db->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $propiedad = $resultado->fetch_assoc();
    $stmt->close();

    if (!$propiedad) {
        header('Location: /admin');
        exit;
    }

    // ======================
    // 4) Obtener vendedores
    // ======================
    $consulta = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consulta);

    // ======================
    // 5) Variables iniciales (para mostrar en el form)
    // ======================
    $errores = [];

    $titulo         = $propiedad['titulo'] ?? '';
    $precio         = $propiedad['precio'] ?? '';
    $descripcion    = $propiedad['descripcion'] ?? '';
    $habitaciones   = $propiedad['habitaciones'] ?? '';
    $wc             = $propiedad['wc'] ?? '';
    $estacionamiento= $propiedad['estacionamiento'] ?? '';
    $vendedores_Id  = $propiedad['vendedores_id'] ?? '';
    $imagenPropiedad= $propiedad['imagen'] ?? '';

    $resultadoOperacion = $_GET['resultado'] ?? null;

    // ======================
    // 6) POST: validar + actualizar
    // ======================
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Strings
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        // Ints (validación REAL)
        $precio = filter_var($_POST['precio'] ?? null, FILTER_VALIDATE_INT);
        $habitaciones = filter_var($_POST['habitaciones'] ?? null, FILTER_VALIDATE_INT);
        $wc = filter_var($_POST['wc'] ?? null, FILTER_VALIDATE_INT);
        $estacionamiento = filter_var($_POST['estacionamiento'] ?? null, FILTER_VALIDATE_INT);
        $vendedores_Id = filter_var($_POST['vendedor'] ?? null, FILTER_VALIDATE_INT);

        // Archivo (puede venir vacío)
        $imagen = $_FILES['imagen'] ?? null;

        // ======================
        // Validaciones
        // ======================
        if ($titulo === '') {
            $errores[] = 'Debes añadir un título';
        }

        $precioRaw = str_replace(',', '.', trim($_POST['precio'] ?? ''));
        $precio = filter_var($precioRaw, FILTER_VALIDATE_FLOAT);

        if ($precio === false) {
            $errores[] = 'Debes añadir un precio válido';
        }

        if (strlen($descripcion) < 50) {
            $errores[] = 'Debes añadir una descripción mayor a 50 caracteres';
        }

        if ($habitaciones === false || $habitaciones === null) {
            $errores[] = 'Debes añadir habitaciones válidas';
        }

        if ($wc === false || $wc === null) {
            $errores[] = 'Debes añadir un wc válido';
        }

        if ($estacionamiento === false || $estacionamiento === null) {
            $errores[] = 'Debes añadir estacionamiento válido';
        }

        if ($vendedores_Id === false || $vendedores_Id === null) {
            $errores[] = 'Debes seleccionar un vendedor válido';
        }

        // ======================
        // Imagen opcional (si sube, validar)
        // ======================

        // Carpeta donde se guardarán las imágenes en el servidor
        $carpetaImagenes = '../../imagenes/';

        // Guardamos el nombre de la imagen anterior (la que ya tenía la propiedad en BD)
        // Esto se usa luego para borrarla SOLO si todo el proceso (UPDATE) fue exitoso
        $imagenAnterior  = $imagenPropiedad;

        // Por defecto, si el usuario NO sube imagen nueva, conservamos la imagen actual
        $nombreImagen    = $imagenPropiedad;

        // Tamaño máximo permitido: 1MB (en bytes)
        $medida          = 1000 * 1000;

        // Bandera para saber si efectivamente se subió una imagen nueva al servidor
        // (sirve para decidir si luego se borra la anterior)
        $subioNuevaImagen = false;

        // Detecta si el usuario intentó subir una imagen:
        // - Existe $_FILES['imagen']
        // - Tiene índice 'error'
        // - Y no es "no se subió ningún archivo"
        $hayImagenNueva = ($imagen && isset($imagen['error']) && $imagen['error'] !== UPLOAD_ERR_NO_FILE);

        if ($hayImagenNueva) {

            // 1) Validación de errores de carga a nivel PHP
            // UPLOAD_ERR_OK significa que el upload llegó bien al servidor (en tmp)
            if ($imagen['error'] !== UPLOAD_ERR_OK) {
                $errores[] = 'Error al subir la imagen';
            } else {

                // 2) Validación de tamaño
                if ($imagen['size'] > $medida) {
                    $errores[] = 'La imagen debe ser máximo de 1MB';
                }

                // 3) Validación de tipo real (MIME) usando el archivo temporal
                // Esto es más confiable que validar por extensión (.jpg/.png)
                $mime = mime_content_type($imagen['tmp_name']);

                // Lista de tipos permitidos y extensión asociada para guardar el archivo
                $permitidos = [
                    'image/jpeg' => 'jpg',
                    'image/png'  => 'png',
                ];

                // Si el MIME no está permitido, se rechaza el archivo
                if (!array_key_exists($mime, $permitidos)) {
                    $errores[] = 'Formato no permitido (solo JPG o PNG)';
                }

                // 4) Si no hay errores hasta aquí, se procede a guardar la imagen
                if (empty($errores)) {

                    // Si la carpeta no existe, la crea con permisos 0755
                    if (!is_dir($carpetaImagenes)) {
                        mkdir($carpetaImagenes, 0755, true);
                    }

                    // Determina la extensión final según el MIME validado
                    $ext = $permitidos[$mime];

                    // Genera un nombre único para evitar colisiones (repetidos)
                    // md5 + uniqid + rand => nombre pseudo-único
                    $nombreImagen = md5(uniqid(rand(), true)) . "." . $ext;

                    // Mueve el archivo desde la ruta temporal a la carpeta final
                    // Si esto sale bien, $subioNuevaImagen queda en true
                    $subioNuevaImagen = move_uploaded_file(
                        $imagen['tmp_name'],
                        $carpetaImagenes . $nombreImagen
                    );

                    // Si falla el movimiento, se agrega error
                    if (!$subioNuevaImagen) {
                        $errores[] = 'No se pudo guardar la imagen en el servidor';
                    }
                }
            }
        }

            
        

        // ======================
        // UPDATE
        // ======================
        if (empty($errores)) {

            $stmt = $db->prepare("
                UPDATE propiedades SET
                    titulo = ?,
                    precio = ?,
                    imagen = ?,
                    descripcion = ?,
                    habitaciones = ?,
                    wc = ?,
                    estacionamiento = ?,
                    vendedores_id = ?
                WHERE id = ? 
            "); // el WHERE id permite que solo se actualice el registro actual y no actualice todos los registros de forma simultanea.

            if (!$stmt) {
                die("Error prepare UPDATE: " . $db->error);
            }

            // Tipos: s=string, i=int
            // titulo(s), precio(i), imagen(s), descripcion(s), habitaciones(i), wc(i), estacionamiento(i), vendedor(i), id(i)
            $stmt->bind_param(
                "sdssiiiii",
                $titulo,
                $precio,
                $nombreImagen,
                $descripcion,
                $habitaciones,
                $wc,
                $estacionamiento,
                $vendedores_Id,
                $id
            );

            $ok = $stmt->execute();

            // ✅ borrar imagen anterior solo si el UPDATE fue exitoso
            if ($ok && $hayImagenNueva && $subioNuevaImagen && $imagenAnterior && $imagenAnterior !== $nombreImagen) {
                $rutaAnterior = $carpetaImagenes . $imagenAnterior;
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }

            if (!$ok) {
                die("Error execute UPDATE: " . $stmt->error);
            }

            $stmt->close();

            header('Location: /admin?resultado=2');
            exit;
        }
    }

    // ======================
    // 7) Template / HTML
    // ======================
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <!-- inicia HTML -->
        <main class="contenedor seccion">
            <h1>Actualizar</h1>

            <a href="/admin" class="boton boton-verde">Volver</a>

            <?php foreach ($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

            <form class="formulario" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Información general</legend>

                    <label for="titulo">Titulo:</label>
                    <input 
                        type="text" 
                        id="titulo" 
                        name="titulo" 
                        placeholder="Titulo Propiedad" 
                        value="<?php echo $titulo; ?>">

                    <label for="precio">Precio:</label>
                    <input 
                        type="number" 
                        id="precio" 
                        name="precio" 
                        placeholder="Precio Propiedad" 
                        step="0.01"
                        min="0"
                        value="<?php echo $precio; ?>">

                    <label for="imagen">Imagen: </label>
                    <input 
                        type="file" 
                        id="imagen" 
                        accept="image/jpeg, image/png"
                        name="imagen">
                    <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small" alt="">

                    <label for="descripcion">Descripción:</label>
                    <textarea 
                        name="descripcion" 
                        id="descripcion"><?php echo $descripcion; ?></textarea>
                </fieldset>

                <fieldset>
                    <legend>Información Propiedad</legend>

                    <label for="habitaciones">Habitaciones:</label>
                    <input 
                        type="number" 
                        id="habitaciones" 
                        name="habitaciones" 
                        placeholder="habitaciones" 
                        min="1" 
                        max="10" 
                        value="<?php echo $habitaciones; ?>">

                    <label for="wc">baños:</label>
                    <input 
                        type="number" 
                        id="wc" 
                        name="wc" 
                        placeholder="baños" 
                        min="1" 
                        max="10" 
                        value="<?php echo $wc ; ?>">

                    <label for="estacionamiento">Estacionamientos:</label>
                    <input 
                        type="number" 
                        id="estacionamiento" 
                        name="estacionamiento" 
                        placeholder="estacionamiento" 
                        min="1" 
                        max="10" 
                        value="<?php echo $estacionamiento; ?>">
                </fieldset>

                <fieldset>
                    <select name="vendedor" id="vendedor">
                        <option value="" disabled <?php echo ($vendedores_Id === '') ? 'selected' : ''; ?>>
                            **Seleccione**
                        </option>

                        <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedores)): ?>
                            <option 
                            value="<?php echo $vendedor['id']; ?>"
                            <?php echo ((string)$vendedores_Id === (string)$vendedor['id']) ? 'selected' : ''; ?>
                            >
                            <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    
                </fieldset>

                <input type="submit" value="Actualizar" class="boton boton-verde">
            </form>
        </main>

    <?php

        incluirTemplate('footer');
    ?>

