/*

This JavaScript file is responsible for handling the text formatting on the proposals

 */

function iFrameOn(){
    editor.document.designMode ='On';
}

function Redo(){
    editor.document.execCommand('redo',false,null);
}

function Undo(){
    editor.document.execCommand('undo',false,null);
}

function JustifyLeft(){
    editor.document.execCommand('JustifyLeft',false,null);
}

function JustifyCenter(){
    editor.document.execCommand('JustifyCenter',false,null);
}

function JustifyRight(){
    editor.document.execCommand('JustifyRight',false,null);
}

function Bold(){
    editor.document.execCommand('bold',false,null);
}

function Italic(){
    editor.document.execCommand('italic',false,null);
}

function Underline(){
    editor.document.execCommand('underline',false,null);
}

function UnorderedList(){
    editor.document.execCommand('InsertUnorderedList',false,"newUL");
}

function OrderedList(){
    editor.document.execCommand('InsertOrderedList',false,"newOL");
}

function Indent(){
    editor.document.execCommand('Indent',false,null);
}

function Outdent(){
    editor.document.execCommand('Outdent',false,null);
}

function Link(){
    var linkURL = prompt('Enter the URL', 'http://');
    editor.document.execCommand('CreateLink',false,linkURL);
}

function UnLink(){
    editor.document.execCommand('UnLink',false,null);
}

function TextSize(){
    var size = document.getElementById('FontSize').value;
    editor.document.execCommand('FontSize',false,size);
}

function TextColour(){
    var colour = document.getElementById('FontColour').value;
    editor.document.execCommand('ForeColor',false,colour);
}

function TexFont(){
    var colour = document.getElementById('FontType').value;
    editor.document.execCommand('fontname',false,colour);
}

function submit_form(){
    var Form = document.getElementById("text_editor");
    Form.elements["description"].value = window.frames["editor"].document.body.innerHTML;
    Form.submit();
}
