/* -------------------------------------------------------------------------- */
/*                                 SUMMERNOTE                                 */
/* -------------------------------------------------------------------------- */

$(".summernote").summernote();

/* -------------------------------------------------------------------------- */
/*                     ELIMINAR IMAGEN EN EDITAR PREGUNTA                     */
/* -------------------------------------------------------------------------- */


/* var inputImagen = $(".prevImagenPregunta").attr("src"); */

/* var botonEliminaImagen = document.getElementById("eliminaImagen");
$(botonEliminaImagen).on("click", function() {
  var inputFileImagen = document.getElementById("borrar");
  console.log(inputFileImagen);
  inputFileImagen.remove();
  console.log(inputFileImagen);
}); */
/* $("#clear").on("click", function () {
    control.attr("src","");
}); */
/* $("#botonEliminar").after(
  "<input type='button' class='limpiar-inputfile' value='Eliminar imagen'>"
);
 */

 
  $(".limpiar-inputfile").click(function () {
    var control = $(".prevImagenPregunta");
    control.remove();
    /* Ponemos el valor de ambos inputs de imagen a null: */
    var inputImagen = $("input[name=imagenPregunta]");
    console.log(inputImagen);
    console.log(inputImagen[0].defaultValue);
    inputImagen[0].defaultValue = null;
    console.log(inputImagen[0].defaultValue);
    var inputImagenDos = $("input[name=imagenPregunta2]");
    console.log(inputImagenDos);
    inputImagenDos[0].defaultValue = null;
    
    /* Borramos el div con el input que aparece si ya hay alguna imagen guardada en la base de datos: */
    var divContieneInputImagen =  $("#borrar");
    divContieneInputImagen.remove();

    /* Añadimos el input que saldría si no hubiese ninguna imagen guardada en la base de datos: */
    var divFormImagen = $("#imagen");
    divFormImagen.append(`
        <div class="form-group" id="imagenPregunta">
          <label>Adjuntar imagen (opcional):</label>
          <input type="file" name="imagenPregunta">
          
        </div>
    `);

      $("#actualizarPregunta").attr("disabled",false);
      $(".formatoInvalido").remove();
      return false;
  });


/* -------------------------------------------------------------------------- */
/*                               IMAGEN PREGUNTA                              */
/* -------------------------------------------------------------------------- */
$("#imagenPregunta2").change(function(){
  
  $(".formatoInvalido").remove();
  
    
    var imagen = this.files[0];
    
    
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
  
      if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png" && imagen["type"] != "image/bmp" && imagen["type"] != "image/svg+xml" && imagen["type"] != "image/gif"){
  
        $("#actualizarPregunta").attr("disabled",true);
   
        $("#fotoOpinion").val("");
  
        $("#imagen").after(`

          <div class="alert alert-danger formatoInvalido">¡Formato inválido de imagen! La imagen debe estar en formato JPG, PNG, GIF, SVG o BMP!</div>
          
        `)
  
        return;
  
      } else{
  
         var datosImagen = new FileReader;
  
         datosImagen.readAsDataURL(imagen);
  
         $(datosImagen).on("load", function(event){
  
           var rutaImagen = event.target.result;
  
           $(".prevImagenPregunta").attr("src", rutaImagen);
  
         })

         $("#actualizarPregunta").attr("disabled",false);
  
      }
  
  });

