<?php 

include 'includes/templates/header.php';

?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jepg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat esse doloribus ea quibusdam nulla non est, facilis ipsam, voluptatem obcaecati maiores labore asperiores et eos molestias! Iusto voluptas placeat pariatur. dolor sit amet consectetur adipisicing elit Esse, laudantium amet. Molestiae ad id iste provident voluptatibus est quam non ipsam porro. Quaerat asperiores, quod praesentium suscipit aut error? Minus?</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat esse doloribus ea quibusdam nulla non est, facilis ipsam, voluptatem obcaecati maiores labore asperiores et eos molestias.</p>

            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <!-- Título principal del contenido (puede cambiarse según la sección/página) -->
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, natus provident. Reprehenderit tempore alias odio magnam.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono prcio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, natus provident. Reprehenderit tempore alias odio magnam.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono cumplimiento" loading="lazy">
                <h3>Cumplimiento</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, natus provident. Reprehenderit tempore alias odio magnam.</p>
            </div>


        </div>
    </section>

    <?php

include 'includes/templates/footer.php';
 ?>