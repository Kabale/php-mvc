<?php ob_start() ?>   

<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
    <div class="col-md-12" style="display:none;">
        <input name="id" class="form-controle" value="<?= $this->getContext()->getAttribute("restaurant")->getId() ?>">
    </div>
    
    <div style="height:400px; padding:10px;">
        <div class="col-md-5" style="display:inline-block;vertical-align:top;">
            <div class="input-group">
                <div class="custom-file" >
                    <input name="image" type="file" class="custom-file-input" id="inputFile">
                    <label class="custom-file-label" for="inputFile">Choose image</label>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="display:inline-block;">
                <img id="preview" class="image-preview" style="max-width: 600px; max-height:380px">
            </div>    
        </div>
    </div>
    <br><br>
    <div class="col-md-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="restaurant">Create Restaurant</button>
    </div>

</form>

<script>
    window.onload = function() {
        var uploadField = document.getElementById("inputFile");
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