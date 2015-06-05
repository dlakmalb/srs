<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
require_once ('utility.php');
?> 

<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('comcourses') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Compulsory Courses Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Search Specialization Field</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="POST">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectfield" class="col-md-2 control-label">Specialization Field</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectfield" name="selectfield">
                                                        <?php
                                                        foreach ($Field_Doc as $fieldname => $docname) {
                                                             echo "<option value='" . $docname . "'>" .$fieldname . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>                                          
                                        </fieldset>                                        
                                    </form>
                                    <div id="compdf">
                                        <object width="1000" height="1200" type="application/pdf" data="" id="pdf_content">;
                                            <p>Cannot Generate PDF</p>
                                        </object>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div> 
            </div>
        </div>
        
        <script>
        function display_doc()
        {
            var docname = $("#selectfield").val()
            $("#pdf_content").attr('data',"documents/" + docname);
        }
        $(function ()
            {
                display_doc();
                 $("#selectfield").change(display_doc);
            }    
          );
          
        </script>
        <script>$("#selectfield").select2({placeholder: "Select Specialization Field"});</script>
    </body>
</html>
