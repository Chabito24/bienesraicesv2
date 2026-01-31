<?php

require 'includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jepg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="casa 1">
        </picture>

        <div class="anuncio resumen-propiedad">
            <p class="precio">$350.000.000</p>

            <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" oading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono parqueadero">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p>4</p>
                        </li>
                    </ul>                  

            <p class="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat esse doloribus ea quibusdam nulla non est, facilis ipsam, voluptatem obcaecati maiores labore asperiores et eos molestias! Iusto voluptas placeat pariatur. dolor sit amet consectetur adipisicing elit Esse, laudantium amet. Molestiae ad id iste provident voluptatibus est quam non ipsam porro. Quaerat asperiores, quod praesentium suscipit aut error? Minus?</p>

            <p class="justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat esse doloribus ea quibusdam nulla non est, facilis ipsam, voluptatem obcaecati maiores labore asperiores et eos molestias.</p>
        
        </div>    

    </main>

<?php

    incluirTemplate('footer');
 ?>


