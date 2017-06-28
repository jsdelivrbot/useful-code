function tinyEpaper(el_id) {
  //console.log(el_id);
    $(el_id).tinymce({
      // Location of TinyMCE script
      script_url : 'tinymce/js/tinymce/tinymce.min.js',
      language : "zh_TW", // change language here
      theme: "modern",
      content_css : "css/tinymceContent.css",
      force_br_newlines : true,
      force_p_newlines : false,
      forced_root_block : '', // Needed for 3.x
      relative_urls : false,
      remove_script_host : false,
      convert_urls : true,
      
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

function tinyEpaperNoImg(el_id) {
  //console.log(el_id);
    $(el_id).tinymce({
      // Location of TinyMCE script
      script_url : 'tinymce/js/tinymce/tinymce.min.js',
      language : "zh_TW", // change language here
      theme: "modern",
      content_css : "css/tinymceContent.css",
      force_br_newlines : true,
      force_p_newlines : false,
      forced_root_block : '', // Needed for 3.x
      relative_urls : false,
      remove_script_host : false,
      convert_urls : true,
      
      plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
       "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
       "table contextmenu directionality emoticons textcolor responsivefilemanager",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern code"
      ],
      toolbar1: "image | preview code",

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

  
  
  //$('textarea.tiny').reset();
  //tinymce.EditorManager.execCommand('mceAddEditor', true, "textarea.tiny");

}); 