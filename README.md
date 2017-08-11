=== WPeMatico Custom Hooks===
Contributors: albertdesinger
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TVCMLX5GTQ2T2
Tags: dinamic , dinamic text , contact form dinamic text, visual form, contact, form, contact form, feedback, email, ajax, captcha, akismet, multilingual
Requires at least: 4.1
Tested up to: 4.7
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a Contact Form 7 Dynamic Vars  and a code highlighter for contact form 7 forms.  ADD-on.  Requires Contact Form 7 Plugin.

== Descripción ==

Este plugins esta basicamente pensado para desarrolladores. ¿Que hace en si? Se trata de una extension para el contact form 7 el cual te permitira  incrustar codigo php en este caso variables, funciones y shortocdes  los cuales retornen un valor variante es decir dinamico.  De esta forma hacemos de nuestros formularios estaticos lo cual  se restringen por el mismo contact form a hacer de este un formulario capaz de responder a cualquier peticion del desarrollador segun  sea el caso.

Las formas de utilizar el plugin serian las siguientes:

* En un texto: Para agregar valores dinamicos en un formulario de CF7 sin la nesecidad de ser una caja de texto puedes utilizar el shortcode creado especial mente para estos casos el cual seria  [dinamic_vars 'dinamic_var:mivariable'].  La palabra 'mivariable' seria la que contenga el valor que se carga dinamicamente es decir seria la variable php llamada $mivariable.  Si esta posee un valor como por ejemplo $mivariable = 'MUNDO';  si queremos mostrar ese valor en nuestr formulario adaptarlo a un texto existente del mismo seria: HOLA [dinamic_vars 'dinamic_var':'mivariable'] lo que devolveria 'HOLA MUNDO'. 

* En un Campo:  Para agregar valores dinamicos en un campo de texto no hay nesecidad de utilizar shortcodes especiales para esto basta con colocar el mismo atributo 'dinamic_var:tuvariable' en cualquier campo  tomando como ejemplo la primera caracteristica  el cual de la misma forma retornaria el valor y lo mostraria en el campo. Por ejemplo un boton submit con un valor dinamico seria asi:  [submit 'dinamic_var:tuvariabledinamica'] en donde tuvariabledinamica es la que tengas en tu codigo y desees mostrar el valor que posee en cualquier campo de texto, boton etc. Facil no? 

*Para ambos casos de arriba tambien podemos llamar funciones php que creemos y nos retornen un valor en especifico. Para esto no utilizamos la propiedad 'dinamic_var:mivariable' si no que utilizamos 'dinamic_function:mifuncion'  en donde la palabra 'mifuncion' sera el nombre de la funcion que creemos en nuestro codigo php la cual nos retornara un valor variante  o especifico.


*Para ambos los dos primeros casos  tambien podemos llamar shortcodes php que creemos y nos retornen un valor en especifico.De la misma forma  contiene su atributo personal el cual para  llamarlo a la acción seria  'dinamic_shortcode:mishortcode'  en donde la palabra 'mishortcode' sera el nombre de la shortcode que creemos en nuestro codigo php la cual nos retornara un valor variante  o especifico. Tome en cuenta que no es necesario encerrar los shortcodes que llamemos en nuestros campos o textos con corchetes con solo el nombre como se muestra tal cual en el ejemplo podemos llamarlos a la acción. 


== Instalación ==

Puede instalarlo automáticamente desde el administrador de WordPress o hacerlo manualmente:

= Uso del Administrador de Plugins =

1. Haga clic en Plugins
2. Haga clic en Agregar nuevo
3. Búsqueda de 'Formulario de contacto 7 Dynamic Vars`
4. Haga clic en Instalar
5. Haga clic en Instalar ahora.
6. Haga clic en Activar complemento


==  Manual ==

Cargue la carpeta `contact-form-7-dinamic-vars` al directorio `wp-content/plugins/`
2. Active el plugin a través del menú "Plugins" en WordPress

== Screenshots ==


1. Primero mostramos las variables que tienen un valor el cual queremos visualizar en   nuestro formulario de contacto 7

2. Para llamar a las variables en nuestro formulario de contacto 7 usamos  ambas variables dinamicas segun su tipo. La primera obtiene el valor de la variable $mytitle y lo mostraremos como un título de la página. 
La segunda forma muestra el valor de $myvalue esto lo hace dentro del campo de texto

3. Finalmente vemos cómo los datos que las variables habían almacenado se muestran de forma satisfactoria en nuestro formulario de contacto. Simple no


== Changelog ==

= 1.0 =
Plugins en su version beta

