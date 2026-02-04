<?php

//BD
require '../../includes/config/database.php';

$db = conectarDB();

$consulta = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $consulta);

// var_dump($db);

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

// echo '<pre>';
// var_dump($_GET);
// echo '</pre>';

$errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedores_Id = '';

$resultadoOperacion = $_GET['resultado'] ?? null;



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';

    $titulo = mysqli_real_escape_string($db, $_POST['titulo'] ?? '');
    $precio = mysqli_real_escape_string($db, $_POST['precio'] ?? '');
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] ?? '');
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] ?? '');
    $wc = mysqli_real_escape_string($db, $_POST['wc'] ?? '');
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] ?? '');
    $vendedores_Id = mysqli_real_escape_string($db, $_POST['vendedor'] ?? '');
    $imagen = $_FILES['imagen'];

    if(!$titulo) {
        $errores[] = 'debes añadir un titulo';
    }

    if(!$precio) {
        $errores[] = 'debes añadir un precio';
    }

    if(strlen( $descripcion ) < 50 ) {
        $errores[] = 'debes añadir una descripcion mayor a 50 caracteres';
    }

    if(!$habitaciones) {
        $errores[] = 'debes añadir una habitación';
    }

    if(!$wc) {
        $errores[] = 'debes añadir un wc';
    }

    if(!$estacionamiento) {
        $errores[] = 'debes añadir un estacionamiento';
    }

    if(!$vendedores_Id) {
        $errores[] = 'debes añadir un Vendedor';
    }

    if(!$imagen['name'] || $imagen['error']) {
        $errores[] = 'imagen obligatoria';
    }

        $medida = 1000 * 1000;

    if($imagen['size'] > $medida ) {
        $errores[] = 'la imagen debe ser maximo de 1Mb';
    }


    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    if (empty($errores)) {

    //subir archivos
    $carpetaImagenes = '../../imagenes/';
    
    if(!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
    }

    $nombreImagen = md5(uniqid( rand(), true )) .".jpg";

    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
    

    // Cast/validación básica
    $precio = filter_var($_POST['precio'] ?? null, FILTER_VALIDATE_INT);
    $habitaciones = filter_var($_POST['habitaciones'] ?? null, FILTER_VALIDATE_INT);
    $wc = filter_var($_POST['wc'] ?? null, FILTER_VALIDATE_INT);
    $estacionamiento = filter_var($_POST['estacionamiento'] ?? null, FILTER_VALIDATE_INT);
    $vendedores_Id = filter_var($_POST['vendedor'] ?? null, FILTER_VALIDATE_INT);

    if ($precio === false) $errores[] = 'precio inválido';
    if ($habitaciones === false) $errores[] = 'habitaciones inválidas';
    if ($wc === false) $errores[] = 'wc inválido';
    if ($estacionamiento === false) $errores[] = 'estacionamiento inválido';
    if ($vendedores_Id === false) $errores[] = 'vendedor inválido';

    if (empty($errores)) {
        $stmt = $db->prepare("
            INSERT INTO propiedades
            (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), ?)
        ");

        if (!$stmt) {
            die("Error prepare: " . $db->error);
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        // Tipos: s=string, i=int
        $stmt->bind_param("sissiiii", $titulo, $precio, $nombreImagen, $descripcion, $habitaciones, $wc, $estacionamiento, $vendedores_Id);

        $ok = $stmt->execute();

        if (!$ok) {
            die("Error execute: " . $stmt->error);
        } else {
            header('Location: /admin?resultado=1');
            exit;
        }

        $stmt->close();
        }

       
    }  

}




require '../../includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>

 <!-- inicia HTML -->
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
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
                    value="<?php echo $precio; ?>">

                <label for="imagen">Imagen: </label>
                <input 
                    type="file" 
                    id="imagen" 
                    accept="image/jpeg, image/png"
                    name="imagen">

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

            <input type="submit" value="Crear" class="boton boton-verde">
        </form>
    </main>

<?php

    incluirTemplate('footer');
 ?>
