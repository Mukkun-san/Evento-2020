let validimgExtensions = [".jpg", ".jpeg", ".gif", ".png"];
function ValidateImgInput(Image) {
    if (Image.type == "file") {
        var FileName = Image.value;
        if (FileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < validimgExtensions.length; j++) {
                var Extension = validimgExtensions[j];
                if (FileName.substr(FileName.length - Extension.length, Extension.length).toLowerCase() == Extension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Sorry, " + Image.files.item(0).name + " is not a valid image file. \nAllowed image extensions are: " + validimgExtensions.join(", "));
                Image.value = "";
                return false;
            }
        }

        ValidateSize(Image);

    }
    return true;
}

function ValidateSize(file) {
    var FileSize = file.files[0].size / 1024 / 1024; // convert size to MB from BYTE
    if (FileSize > 5) {
        alert('Image size exceeds 5 MB');
        file.value = "";
    }
}