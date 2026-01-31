<?php

$inicio = true;
 include 'includes/templates/header.php';
 ?>

    <!-- Contenido principal de la página -->
    <main class="contenedor seccion">
        <!-- Título principal del contenido (puede cambiarse según la sección/página) -->
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, natus provident. Reprehenderit tempore alias odio magnam.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, natus provident. Reprehenderit tempore alias odio magnam.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono cumplimiento" loading="lazy">
                <h3>Cumplimiento</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, natus provident. Reprehenderit tempore alias odio magnam.</p>
            </div>


        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Casas y Aptos en venta</h2>

        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type ="image/webp">
                    <source srcset="build/img/anuncio1.jpg" type ="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio1.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa en Cedritos</h3>
                    <p>Casa de 200 mts2 con excelente vista de la ciudad, con acabados a un excelente precio</p>
                    <p class="precio">$350.000.000</p>
                    
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
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

                    <a href="anuncio.php" class="boton boton-amarillo">ver</a>
                </div>

                
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type ="image/webp">
                    <source srcset="build/img/anunci02.jpg" type ="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio2.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Apto. en Alameda</h3>
                    <p>Casa de 200 mts2 con excelente vista de la ciudad, con acabados a un excelente precio</p>
                    <p class="precio">$350.000.000</p>
                    
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
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

                    <a href="anuncio.php" class="boton boton-amarillo">ver</a>
                </div>

                
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type ="image/webp">
                    <source srcset="build/img/anuncio3.jpg" type ="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio3.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa en La Colina</h3>
                    <p>Casa de 200 mts2 con excelente vista de la ciudad, con acabados a un excelente precio</p>
                    <p class="precio">$350.000.000</p>
                    
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
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

                    <a href="anuncio.php" class="boton boton-amarillo">ver</a>
                </div>            
            </div>
        </div>
        
        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se comunicará contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo-inlineblock ">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>blog</h3>

            <article>
                <div class="entrada-blog">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jepg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p 0class="informacion-meta">escrito el <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores materiales, ahorrando dinero.
                        </p>
                    </a>
                </div>
            </article>

            <article>
                <div class="entrada-blog">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jepg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoración de tu hogar</h4>
                        <p class="informacion-meta">escrito el <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio.
                        </p>
                    </a>
                </div>
            </article>

        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de excelente forma, muy buena la atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>Edward Martínez</p>
            </div>
        </section>
    </div>

    <!-- Footer / pie de página -->
    <footer class="footer seccion">
        <!-- Contenedor interno del footer -->
        <div class="contenedor contenedor-footer">

            <!-- Navegación repetida en el footer (accesibilidad / experiencia de usuario) -->
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <!-- Texto de derechos reservados -->
        <p class="copyrigth">Todos los derechos Reservados 2026 &copy;</p>
    </footer>

    <!-- Script final compilado/minificado (bundle con JS del proyecto) -->
    <script src="build/js/bundle.min.js" defer></script> <!-- Se agrega script para incorporar bundle.min.js -->
    
</body>
</html>
