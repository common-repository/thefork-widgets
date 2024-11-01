jQuery(document).ready(function($) {

/*       Imputs validation 
-------------------------------------------*/
function checkInput(idInput) {
        // console.log($(idInput).val());
        var uidNum = $(idInput).val();

        if(uidNum && Math.floor(uidNum) == uidNum){
                return true;
        }else{
                return false;
        }
}

/*       Checkboxes validation
--------------------------------------------*/
function checkSelect(idSelect) {
        return $(idSelect).val() ? true : false;
}


/*   Submit button activation-deactivaction
-----------------------------------------------*/
function enableSubmit (idButton) {
        $(idButton).removeAttr("disabled");
}
 
function disableSubmit (idButton) {
        $(idButton).attr("disabled", "disabled");
}


/*             Form validation
----------------------------------------------------------------------------*/
function checkForm () {
        $("#tfw-uidValue, #tfw-lngValue").on("change keydown", function() {
                console.log("checkForm");
                if (checkInput("#tfw-uidValue") &&  checkSelect("#tfw-lngValue"))
                {
                        console.log("Enable");
                        enableSubmit('#tfw-submit');
                } else {
                        console.log("disabled");
                        disableSubmit('#tfw-submit');
                }
        });
}


/*   Action if submit button is available 
----------------------------------------------------------*/
$(document).ready(function() {
	checkForm();
    $('#tfw-submit').click(function() {
        var uidVal = $('#tfw-uidValue').val().trim();
        var lang = $('#tfw-lngValue').val();
        var theHash = "";
        theHash = getTheHash(uidVal);
        showTheWidget(lang, uidVal, theHash);

    });
});


/*    Get the hash value
-----------------------------------------------------*/
function getTheHash(uidVal){
        var hashVal="";
        var strMD5 = $().crypt({
                method: "md5",
                source: "CESHTMOTW"+uidVal
        });

        hashVal= strMD5.substr(0,5);
        return hashVal;
}


/*   Show the widget in the admin preview place
----------------------------------------------------------------------------------*/
function showTheWidget(lang, uidVal, theHash){

        var html = "";
        widgetType= "iframe";

        switch (widgetType) { 
                case 'iframe': 
                        html = '<iframe src="https://module.lafourchette.com/'+ lang + '/module/'+ uidVal + '-' + theHash + ' " style="width: 100%; min-height:800px; border:none; scrolling:yes;"></iframe>';
                       //text = '&lt;iframe src="https://module.lafourchette.com/'+ lang + '/module/'+ uidVal + '-' + theHash + ' " style="width: 100%; min-height:800px; border:none; scrolling:yes;"&gt;&lt;/iframe&gt;';
                        break;
                case 'vertical': 
                        html = '<iframe src="https://module.lafourchette.com/'+ lang + '/cta/vertical/'+ uidVal + '-' + theHash + ' " frameborder="0" scrolling="no" allowtransparency="true"  width="100%" height="380px" ></iframe>';
                        //text = '&lt;iframe src="https://module.lafourchette.com/'+ lang + '/cta/vertical/'+ uidVal + '-' + theHash + ' " frameborder="0" scrolling="no" allowtransparency="true" width="100%" height="380px" &gt;&lt;/iframe&gt;';
                        break;
                case 'horizontal': 
                        html = '<iframe src="https://module.lafourchette.com/'+ lang + '/cta/horizontal/'+ uidVal + '-' + theHash + ' " frameborder="0" scrolling="no" allowtransparency="true"  width="100%" height="580px" ></iframe>';
                        //text = '&lt;iframe src="https://module.lafourchette.com/'+ lang + '/cta/horizontal/'+ uidVal + '-' + theHash + ' " frameborder="0" scrolling="no" allowtransparency="true" width="100%" height="580px" &gt;&lt;/iframe&gt;';
                        break;
                case 'button': 
                        html = '<iframe src="https://module.lafourchette.com/'+ lang + '/cta/button/'+ uidVal + '-' + theHash + ' " frameborder="0" scrolling="no" allowtransparency="true"  width="100%" height="380px" ></iframe>';
                        //text = '&lt;iframe src="https://module.lafourchette.com/'+ lang + '/cta/button/'+ uidVal + '-' + theHash + ' " frameborder="0" scrolling="no" allowtransparency="true" width="100%" height="380px" &gt;&lt;/iframe&gt;';
                        break;
                case 'link': 
                        html = '<iframe src="https://module.lafourchette.com/'+ lang + '/module/'+ uidVal + '-' + theHash + ' " style="width: 100%; min-height:800px; border:none; scrolling:yes;"></iframe>';
                        //text = 'https://module.lafourchette.com/'+ lang + '/module/'+ uidVal + '-' + theHash;
                    break;
                default:
                        html = '<iframe src="https://module.lafourchette.com/en_GB/cta/horizontal/56567-a3fd1" frameborder="0" scrolling="no" allowtransparency="true"  width="100%" height="380px" ></iframe>' ;
                        //text = '&lt;iframe src="https://module.lafourchette.com/en_GB/cta/horizontal/56567-a3fd1" frameborder="0" scrolling="no" allowtransparency="true" width="100%" height="380px" &gt;&lt;/iframe&gt;';
        }

        document.getElementById("tfw-shortcode").value= "[tfw-iframe lang= "+ lang + " uid= "+ uidVal +"]";
        document.getElementById("tfw-preview").innerHTML= html;

        console.log(html);


}


} );
