<!--  This is the body view of of the student proposal creation page   -->
<div class="container">
    <div id="create_proposal">
        <div class="page-header">
            <h1>Create Proposal</h1>
        </div>
        <form method="POST" action="<?php echo base_url(); ?>index.php/studentProposal/submitProposal"
              name="text_editor" id="text_editor">
            <div>
                <label for="title">Project Title: </label>
                <input type="text" name="title" placeholder="Project Title"
                       value="<?php echo set_value('title'); ?>"/>
            </div>
            <div style="padding: 8px; width: 700px">

                <img onclick="Redo()" src="<?php echo base_url(); ?>Images/redo.gif" class="pointer"/>
                <img onclick="Undo()" src="<?php echo base_url(); ?>Images/undo.gif" class="pointer"/>
                <img onclick="Bold()" src="<?php echo base_url(); ?>Images/bold.gif" class="pointer"/>
                <img onclick="Italic()" src="<?php echo base_url(); ?>Images/italic.gif" class="pointer"/>
                <img onclick="Underline()" src="<?php echo base_url(); ?>Images/Underline.gif" class="pointer"/>
                <img onclick="UnorderedList()" src="<?php echo base_url(); ?>Images/dottedlist.gif"
                     class="pointer"/>
                <img onclick="OrderedList()" src="<?php echo base_url(); ?>Images/numberedlist.gif"
                     class="pointer"/>
                <img onclick="JustifyLeft()" src="<?php echo base_url(); ?>Images/JustifyLeft.gif" class="pointer"/>
                <img onclick="JustifyCenter()" src="<?php echo base_url(); ?>Images/JustifyCenter.gif"
                     class="pointer"/>
                <img onclick="JustifyRight()" src="<?php echo base_url(); ?>Images/JustifyRight.gif"
                     class="pointer"/>
                <img onclick="Indent()" src="<?php echo base_url(); ?>Images/Indent.gif" class="pointer"/>
                <img onclick="Outdent()" src="<?php echo base_url(); ?>Images/Outdent.gif" class="pointer"/>
                <img onclick="Link()" src="<?php echo base_url(); ?>Images/hyperlink.gif" class="pointer"/>
                <img onclick="UnLink()" src="<?php echo base_url(); ?>Images/unlink.gif" class="pointer"/>
            </div>

            <div>
                <select id="FontSize" onchange="TextSize();">
                    <option>Font Size...</option>
                    <option value="1">Very Small</option>
                    <option value="2">Small</option>
                    <option value="3">Medium</option>
                    <option value="4">Medium-Large</option>
                    <option value="5">Large</option>
                    <option value="6">Extra Large</option>
                    <option value="7">XX Large</option>
                </select>

                <select id="FontColour" onchange="TextColour();">
                    <option>Font Colour...</option>
                    <option value="black">Black</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="grey">Grey</option>
                    <option value="red">Red</option>
                    <option value="yellow">Yellow</option>
                </select>

                <select id="FontType" onchange="TexFont();">
                    <option>Font...</option>
                    <option value="arial">Arial</option>
                    <option value="Arial Black">Arial Black</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Times New Romany">Times New Roman</option>
                </select>

            </div>

            <div>

                <textarea class="display-none" cols="60" rows="30" name="description"></textarea>
                <iframe name="editor" id="editor" class="iframe"></iframe>

                <!-- This script is to reload the description sent  if there was any errors in the validation, this ensures the user content isn't lost-->
                <!-- THis is necessary as the object is an iframe tag, therefore it wont load the data, we need to target the body inside the iFrame -->
                <script>

                    var myFrame = $('#editor').contents().find('body');

                    myFrame.append('<?php
                    if($_POST){
                    //Gets the description from the POST
                    $description = $_POST["description"];
                    //decodes the html tags so content is shown without the tags
                    $description = html_entity_decode($description);

                    echo  $description;}?>');

                </script>
            </div>
            <div>
                <label for="lecturer">Select a Lecturer:</label>
                <select name="lecturer">
                    <option value="0">Select a Lecturer...</option>
                    <?php
                    foreach ($names as $name) {
                        $firstname = $name->first_name;
                        $lastname = $name->last_name;
                        $user_id = $name->user_id;
                        $name = $lastname . ', ' . $firstname;

                        echo '<option value="' . $user_id . '">' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <input name="submitJS" type="button" value="Submit Proposal" class="btn btn-primary"
                       onClick="submit_form();"/>
            </div>
        </form>
    </div>
    <br/>
    <?php echo validation_errors(); ?>
    <br/>
</div>

