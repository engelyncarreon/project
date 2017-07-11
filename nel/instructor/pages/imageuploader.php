<?php
 try {
    
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error'][$i]) ||
        is_array($_FILES['upfile']['error'][$i])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error'][$i]) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here. 
    if ($_FILES['upfile']['size'][$i] > 100000000000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name'][$i]),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        
            'wmv' => 'video/x-ms-wmv',
            'mp4' => 'video/mp4',
//            'flv' => 'video/x-flv',
//            'avi' => 'video/x-msvideo',
//            'mpeg' => 'video/mpeg',
        
            'txt' => 'text/plain',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',

        ),
        true
    )) {
        
        throw new RuntimeException('Invalid file format.');
    }
           

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if(($ext=='jpg')||($ext=='png')||($ext=='gif')){
       if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'][$i],
            sprintf('../uploads/image/%s.%s',
                sha1($_FILES['upfile']['tmp_name'][$i]),
                $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
        }
        $sha = sprintf('../../instructor/uploads/image/%s.%s',
                sha1($_FILES['upfile']['tmp_name'][$i]),
                $ext
                );
        $type = "image";
       
    }
    
    else if(($ext=='docx')||($ext=='xlsx')||($ext=='pptx')||($ext=='txt')){
        echo "hateful";
       if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'][$i],
            sprintf('../uploads/file/%s.%s',
                sha1($_FILES['upfile']['tmp_name'][$i]),
                $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
        }
        $sha = sprintf('../../instructor/uploads/file/%s.%s',
                sha1($_FILES['upfile']['tmp_name'][$i]),
                $ext
                );
        $type = "document";
      
    }
   else if($ext=='mp4'){
       if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'][$i],
            sprintf('../uploads/video/%s.%s',
                sha1($_FILES['upfile']['tmp_name'][$i]),
                $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
        }
       $sha = sprintf('../../instructor/uploads/video/%s.%s',
                sha1($_FILES['upfile']['tmp_name'][$i]),
                $ext
                );
       
       $type = "Video";
        
    }
              
    

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
?>