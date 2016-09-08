<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js" ></script>
<script type="text/javascript">

function tinyfy(el_id) {
        tinyMCE.settings = {     
                mode : "none",
                theme : "advanced",
                plugins : "spellchecker,preview",
                theme_advanced_buttons1 : "bold,italic,underline,|,sub,sup,|,bullist,numlist,|,cut,copy,paste,|,undo,redo,|,image,link,unlink,|,code,preview,removeformat,visualaid,charmap,spellchecker",
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : false
        };

        tinyMCE.execCommand('mceAddControl', false, el_id);

};

$(document).ready(function() {

tinyfy('article1');

        $( '#btnAdd' ).click( function() {
                var num = $( '.clonedInput' ).length;           // how many "duplicatable" input fields we currently have
                var newNum      = new Number( num + 1 );        // +1 to the current number of fields

                $("#articles").append('<div id="input' + newNum + '" class="clonedInput" style="margin-bottom:4px;"><ul><li>Article Title:</li><li><input type="text" name="title' + newNum + '" id="title' + newNum + '" size="100"$

                tinyfy('article' + newNum); // startup the tinyMCE editor for the new div

                $( '#btnDel' ).attr( 'disabled', false ); // we have more than one article, so enable the delete button
                if ( newNum == 5 ) // allow 5 articles
                        $( '#btnAdd' ).attr( 'disabled', 'disabled' ); // then disable the add button
        });

        $( '#btnDel' ).click( function() {
                var num = $( '.clonedInput' ).length;           // how many "duplicatable" input fields we currently have
                tinyMCE.execCommand('mceFocus', false, 'article' + num); // focus on the last editor 
                tinyMCE.execCommand('mceRemoveControl', false, 'article' + num); // remove the last editor instance
                $( '#input' + num ).remove();                           // remove the last div    
                $( '#btnAdd' ).attr( 'disabled', false );       // enable the "add" button

                // if only one element remains, disable the "remove" button
                if ( num-1 == 1 )
                        $( '#btnDel' ).attr( 'disabled', 'disabled' );   
        });

        $( '#btnDel' ).attr( 'disabled', 'disabled' ); // delete button is disabled by default

});                                                                                                      

</script>