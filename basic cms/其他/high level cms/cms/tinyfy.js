function tinyfy(el_id) {
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

  $('.addTage').on('click', function(){
    var rowindex = (($('#addArea tr').length)/2)+1;
    //var rowindex = $("#addArea").closest('tr').index();
    // console.debug('rowindex', rowindex);
    // console.log('rowindex', rowindex);
    console.log("tab_title = "+ $("#tab_title"+(rowindex-1)).val());
    console.log("tab_content = "+ $("#tab_content"+(rowindex-1)).val());

    if(( $("#tab_title"+(rowindex-1)).val()=="" ) || ( $("#tab_content"+(rowindex-1)).val()=="" )){
      alert("尚有頁籤名稱或頁籤內容未填寫!!");
    }else{
       var addTxt = '<tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤名稱</td><td><input name="tab_title[]" type="text" class="table_data" id="tab_title'+rowindex+'" value="" size="70" /></td><td width="250" bgcolor="#e5ecf6">&nbsp;</td></tr><tr><td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">頁籤內容</td><td><textarea name="tab_content[]" cols="100" rows="20" class="table_data tiny" id="tab_content'+rowindex+'"></textarea></td><td width="250" bgcolor="#e5ecf6"><span class="note_letter">*小斷行請按Shift+Enter。</span></td></tr>';

      $('#addArea').append(addTxt);

      //console.log('tab_content', rowindex);

      //tinyMCE.execCommand('mceFocus', false, 'tab_content' + rowindex); // focus on the last editor
      tinyfy('#tab_content' + rowindex);
    }

   

    /*$("#tab_content"+rowindex).load(function(){
      initTinyMce();
    });*/
  });
  
  //$('textarea.tiny').reset();
  //tinymce.EditorManager.execCommand('mceAddEditor', true, "textarea.tiny");

}); 