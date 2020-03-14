$('.ul_link').hide();
function filterSelection(subgrupo_servicios_id) {
  location.href = './servicios.php?subgrupo_servicios_id='+subgrupo_servicios_id;
}
$('.menu_sub_servicios').on("click", function(){
  // var cacharId=this.val();
  console.log("holi");
});
function toggle_submenu(id){

    var todas = $('.menu_sub_servicios').children();
    var imagen = $('#img_'+id);
    var ul_menu = $('#ul_'+id);

    $('.ul_link').hide('fast');

    todas.attr('src','./img/menu_suproductos_up.svg');
    imagen.attr('src','./img/menu_suproductos_down.svg');

    ul_menu.show('fast');


}

 $('.searchbar').keyup(function (){
 	$(".filterDiv").hide();
   	var valor = $(this).val().toUpperCase();

   	$(".filterDiv:contains('"+valor+"')").show();

 });

