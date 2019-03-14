<?php ob_start() ?>   

<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
    <div style="height:400px; border: 1px solid black; padding:10px;">
        <div class="col-md-5" style="display:inline-block;vertical-align:top;">
            <label for="image">Upload Image File: </label>
            <br> 
            <input id="uploadImage" name="image" type="file" accept="image/*" class="inputFile form-control"> 
        </div>    
        <div class="col-md-6" style="display:inline-block;">
            <img id="preview" class="image-preview" style="max-width: 600px; max-height:380px">
        </div>    
    </div>
    <br><br>
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="restaurant">Create Restaurant</button>

    </div>
    
</form>

<script>
    window.onload = function() {
        var uploadField = document.getElementById("uploadImage");
        var imageField = document.getElementById("preview");

        uploadField.onchange = function(event) {
            if(this.files[0].size > 300000){
                alert("File is too big!");
                this.value = "";
            } else {
                imageField.src = URL.createObjectURL(event.target.files[0]);
            }
        };
    }
</script>

<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>