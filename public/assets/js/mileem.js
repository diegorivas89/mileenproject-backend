$(document).ready(function(){
  $('#delete-property').click(function(e) {
    e.preventDefault();
    if(confirm('¿Desea borrar la publicación?') == true){
      $(this).parent().submit()
    }
  });

})
