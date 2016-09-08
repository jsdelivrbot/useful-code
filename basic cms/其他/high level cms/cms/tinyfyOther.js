function tinyfyOther(el_id) {
  //console.log(el_id);
    $(el_id).tinymce({
      // Location of TinyMCE script
      script_url : 'tinymce/js/tinymce/tinymce.min.js',
      language : "zh_TW", // change language here
      theme: "modern",
      content_css : "css/tinymceContent.css",
      
      plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
       "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
       "table contextmenu directionality emoticons textcolor responsivefilemanager",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern code"
      ],
      toolbar1: "styleselect formatselect fontselect fontsizeselect table",
          toolbar2: "bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| bullist numlist outdent indent | link unlink | image",
          toolbar3: "hr removeformat | charmap emoticons | ltr rtl  | visualchars visualblocks nonbreaking | undo redo | cut copy paste | print fullscreen | preview code",

          menubar: false,
          image_advtab: true,          
          external_filemanager_path:"/tang/filemanager/",
     filemanager_title:"Filemanager" ,
     external_plugins: { "filemanager" : "/tang/filemanager/plugin.min.js"},

          style_formats: [        
                  {title: '產品規格使用', block: 'p', classes: 'notep'},
                  {title: '產品備註使用', block: 'p', classes: 'notep2'}
          ]
  });

    //tinyMCE.execCommand('mceAddControl', false, el_id);

};


$(document).ready(function() {

  $('.addTageOther').on('click', function(){
    var rowindex = (($('#addAreaOther tr').length)/2)+1;
    //var rowindex = $("#addAreaOther").closest('tr').index();
    // console.debug('rowindex', rowindex);
    console.log('rowindex', rowindex);
    console.log("tabOther_title = "+ $("#tabOther_title"+(rowindex-1)).val());
    console.log("tabOther_content = "+ $("#tabOther_content"+(rowindex-1)).val());

    if(( $("#tabOther_title"+(rowindex-1)).val()=="" ) || ( $("#tabOther_content"+(rowindex-1)).val()=="" )){
      alert("尚有頁籤名稱或頁籤內容未填寫!!");
    }else{
       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤名稱</td><td><input name="tabOther_title[]" type="text" class="table_data" id="tabOther_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤內容</td><td><textarea name="tabOther_content[]" cols="100" rows="20" class="table_data tiny" id="tabOther_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr>';

      $('#addAreaOther').append(addTxt);

      //console.log('tabOther_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tabOther_content' + rowindex); // focus on the last editor
      tinyfyOther('#tabOther_content' + rowindex);
    }

   

    /*$("#tabOther_content"+rowindex).load(function(){
      initTinyMce();
    });*/
  });
  
  //$('textarea.tiny').reset();
  //tinymce.EditorManager.execCommand('mceAddEditor', true, "textarea.tiny");

}); 