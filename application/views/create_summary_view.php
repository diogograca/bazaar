<!--  This is the body view of create project summary page   -->
<div class="container">
    <div class="page-header">
        <h1>Create Project Summary</h1>
    </div>
</div>
<div class="container">
    <?php
    $attributes = array('name' => 'text_editor', 'id' => 'text_editor');
    ?>
    <?php echo form_open_multipart('createSummary/create_Summary', $attributes); ?>
    <div>
        <label for="title">Project Title: </label>
        <input type="text" name="title" placeholder="Project Title" value="<?php echo set_value('title'); ?>"/>
    </div>
    <div>

        <div style="padding: 8px; width: 700px">

            <img onclick="Redo()" src="<?php echo base_url(); ?>Images/redo.gif" class="pointer"/>
            <img onclick="Undo()" src="<?php echo base_url(); ?>Images/undo.gif" class="pointer"/>
            <img onclick="Bold()" src="<?php echo base_url(); ?>Images/bold.gif" class="pointer"/>
            <img onclick="Italic()" src="<?php echo base_url(); ?>Images/italic.gif" class="pointer"/>
            <img onclick="Underline()" src="<?php echo base_url(); ?>Images/Underline.gif" class="pointer"/>
            <img onclick="UnorderedList()" src="<?php echo base_url(); ?>Images/dottedlist.gif" class="pointer"/>
            <img onclick="OrderedList()" src="<?php echo base_url(); ?>Images/numberedlist.gif" class="pointer"/>
            <img onclick="JustifyLeft()" src="<?php echo base_url(); ?>Images/JustifyLeft.gif" class="pointer"/>
            <img onclick="JustifyCenter()" src="<?php echo base_url(); ?>Images/JustifyCenter.gif" class="pointer"/>
            <img onclick="JustifyRight()" src="<?php echo base_url(); ?>Images/JustifyRight.gif" class="pointer"/>
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

        <textarea class="display-none" cols="60" rows="30" name="description" id="description"></textarea>
        <iframe name="editor" id="editor" class="iframe"></iframe>

        <!-- This script is to reload the description sent  if there was any errors in the validation, this ensures the user content isn't lost-->
        <!-- THis is necessary as the object is an iframe tag, therefore it wont load the data, we need to target the body inside the iFrame -->
        <script>

            var myFrame = $('#editor').contents().find('body');

            myFrame.append('<?php
                    if($_POST){
                    //Gets the description from the POST
                    $description = $_POST['description'];
                    //decodes the html tags so content is shown without the tags
                    $description = html_entity_decode($description);

                    echo  $description;}?>');

        </script>

    </div>
    <div>
        <p>Upload up to 3 Images:</p>
        <input type="file" name="image" style="width:87px;" onchange="this.style.width = '100%';"/>
        <input type="file" name="image2" style="width:87px;" onchange="this.style.width = '100%';"/>
        <input type="file" name="image3" style="width:87px;" onchange="this.style.width = '100%';"/>
        <br>
        <?php echo validation_errors(); ?>
        <input name="submitJS" type="button" class="btn btn-primary" value="Create Project Summary"
               onClick="submit_form();"/>
    </div>
    </form>
    <br>
</div>

<br>
