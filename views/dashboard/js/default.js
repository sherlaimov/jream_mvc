$(function(){

   $.get('dashboard/xhrGetListings', function(o){

      //alert('belgo');
   for(var i = 0; i < o.length; i++){
      $('#listInserts').append('<td>' + o[i].text + '<a class="del" rel="' + o[i].id + '" href="#">X</a></td>');
   }


      $('.del').on('click', function(){
         var delItem = $(this);
         var id = $(this).attr('rel');
         delItem.parent().remove();
         $.post('dashboard/xhrDeleteListing', {'id': id}, function(o) {

         }, 'json');

         return false;
      });

   }, 'json');



   $('#randomInsert').submit(function(){

      var url = $(this).attr('action');
      var data = $(this).serialize();

      $.post(url, data, function(o){
         console.log(o.text);
        $('listInserts').append('<div>' + o.text + '<a class="del" rel="'+ o.id + '" href="#">X</a></div>')

      }, 'json');

      return false;
   });


});