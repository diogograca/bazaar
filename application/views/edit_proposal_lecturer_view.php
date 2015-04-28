<!--  This is the body view of edit lecturer proposal page   -->
<div class="container">
    <div class="page-header">
        <h1>Edit Project</h1>
    </div>
</div>
<div class="container">
    <?php
    //There will be no result if the user is on the edit page and the changes made doesn't passes on the form validation, therefore just echo the values sent on the POST
    if ($result) {
        foreach ($result as $object) {

            //Gets the description from the POST
            $description = $object->proposal_description;
            //decodes the html tags so content is shown without the tags
            $description = html_entity_decode($description);
            //ensures ' and " are escaped so it doesnt break the code
            $description = addslashes($description);

            ?>
            <div>
                <form method="POST" name="text_editor" id="text_editor"
                      action="<?php echo base_url(); ?>index.php/myProposals/applyChanges">
                    <div>
                        <label for="title">Project Title: </label>
                        <input type="text" name="title" placeholder="Project Title"
                               value="<?php echo $object->proposal_title; ?>"/>
                    </div>

                    <div>

                        <div style="padding: 8px; width: 700px">

                            <img onclick="Redo()" src="<?php echo base_url(); ?>Images/redo.gif" class="pointer"/>
                            <img onclick="Undo()" src="<?php echo base_url(); ?>Images/undo.gif" class="pointer"/>
                            <img onclick="Bold()" src="<?php echo base_url(); ?>Images/bold.gif" class="pointer"/>
                            <img onclick="Italic()" src="<?php echo base_url(); ?>Images/italic.gif" class="pointer"/>
                            <img onclick="Underline()" src="<?php echo base_url(); ?>Images/Underline.gif"
                                 class="pointer"/>
                            <img onclick="UnorderedList()" src="<?php echo base_url(); ?>Images/dottedlist.gif"
                                 class="pointer"/>
                            <img onclick="OrderedList()" src="<?php echo base_url(); ?>Images/numberedlist.gif"
                                 class="pointer"/>
                            <img onclick="JustifyLeft()" src="<?php echo base_url(); ?>Images/JustifyLeft.gif"
                                 class="pointer"/>
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
                    </div>

                    <div>
                            <textarea class="display-none" cols="60" rows="30"
                                      name="description"></textarea>

                        <iframe name="editor" id="editor" class="iframe"></iframe>

                        <!-- This script is to reload the description sent  if there was any errors in the validation, this ensures the user content isn't lost-->
                        <!-- THis is necessary as the object is an iframe tag, therefore it wont load the data, we need to target the body inside the iFrame -->
                        <script>

                            var myFrame = $('#editor').contents().find('body');

                            myFrame.append("<?php

                                    echo  $description?>");
                        </script>
                    </div>
                    <span id="browser"></span>

                    <div>
                        <input class="btn btn-primary" name="submitJS" type="button" value="Edit Proposal"
                               onClick="submit_form();"/>
                        <input type="hidden" name="proposal_id" value="<?php echo $object->proposal_id; ?>"/>
                    </div>
                    <br>
                </form>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_confirmation">
                    Delete Proposal
                </button>
            </div>
            <div class="modal fade" id="delete_confirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Deletion Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this project?</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" data-dismiss="modal">No</a>
                            <a class="btn btn-danger"
                               href="<?php echo base_url() . 'index.php/myProposals/deleteProposal/' . $object->proposal_id ?>">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        $proposal_id = $_POST['proposal_id'];
        ?>
        <div>
            <form method="POST" name="text_editor" id="text_editor"
                  action="<?php echo base_url(); ?>index.php/myProposals/applyChanges">
                <div>
                    <label for="title">Project Title: </label>
                    <input type="text" name="title" placeholder="Project Title"
                           value="<?php echo set_value('title'); ?>"/>
                </div>

                <div>

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
                        <img onclick="JustifyLeft()" src="<?php echo base_url(); ?>Images/JustifyLeft.gif"
                             class="pointer"/>
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
                </div>

                <div>
                        <textarea class="display-none" cols="60" rows="30"
                                  name="description"></textarea>

                    <iframe name="editor" id="editor" class="iframe"></iframe>

                    <!-- This script is to reload the description sent  if there was any errors in the validation, this ensures the user content isn't lost-->
                    <!-- THis is necessary as the object is an iframe tag, therefore it wont load the data, we need to target the body inside the iFrame -->
                    <script>

                        var myFrame = $('#editor').contents().find('body');

                        myFrame.append('<?php
                                //Gets the description from the POST
                                $description = $_POST['description'];
                                //decodes the html tags so content is shown without the tags
                                $description = html_entity_decode($description);
                                //ensures ' and " are escaped so it doesnt break the code
                                $description = addslashes($description);

                                echo  $description?>');

                    </script>

                </div>
                <span id="browser"></span>
                <div>
                    <input class="btn btn-primary" name="submitJS" type="button" value="Edit Proposal"
                           onClick="submit_form();"/>
                    <input type="hidden" name="proposal_id" value="<?php echo $proposal_id; ?>"/>
                </div>
            </form>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_confirmation">
                Delete Proposal
            </button>

            <div class="modal fade" id="delete_confirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Deletion Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this project?</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-default" data-dismiss="modal">No</a>
                            <a class="btn btn-danger"
                               href="<?php echo base_url() . 'index.php/myProposals/deleteProposal/' . $proposal_id?>">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <?php echo validation_errors(); ?>
</div>
<script>
    if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
        $("#browser").append( "<p style='color: red'>Please use Chrome or IE to edit your project as Firefox does not support this functionality!</p>" );
    }
</script>