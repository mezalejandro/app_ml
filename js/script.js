$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false">borrar</a>';
$('a.add').relCopy({ append: removeLink});	
});