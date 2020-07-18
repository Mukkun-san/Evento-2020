let validFileExtensions = [".pdf", ".doc", ".docx", ".pptx", ".ppt", ".xls", ".xlsx"];
function ValidateFileInput(file) {
    if (file.type == "file") {
        var FileName = file.value;
        if (FileName.length > 0) {
            var Valid = false;
            for (var j = 0; j < validFileExtensions.length; j++) {
                var currentExtension = validFileExtensions[j];
                if (FileName.substr(FileName.length - currentExtension.length, currentExtension.length).toLowerCase() == currentExtension.toLowerCase()) {
                    Valid = true;
                    break;
                }
            }
            if (!Valid) {
                alert("Sorry, your file is not a valid document. \nSupported extensions are: " + validFileExtensions.join(", "));
                file.value = "";
                return false;
            }
        }

        ValidateSize(file);

    }
    return true;
}

function ValidateSize(file) {
    var FileSize = file.files[0].size / 1024 / 1024; // convert size to MB from BYTE
    if (FileSize > 50) {
        alert('File size exceeds 50 MB');
        file.value = "";
    } 
}
