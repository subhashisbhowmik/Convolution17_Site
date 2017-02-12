<?php
$pdf="";
if(isset($_REQUEST['pdf'])) $pdf=$_REQUEST['pdf'];
if($pdf=='') die("Please Reopen the link.");
echo "<html>
<head>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/spinner.css\"/>
</head>
<body style='overflow: hidden; text-align: center'>
    <div class=\"spinner\" style=\"position:absolute;bottom:50%;left:50%;z-index:-1\">
                                        <div class=\"bounce1\"></div>
                                        <div class=\"bounce2\"></div>
                                        <div class=\"bounce3\"></div>
                                    </div>
    <object style='z-index:10;height:97vh;width: 97vw; text-align: center' data=\"../pdf/$pdf.pdf\" type=\"application/pdf\">
        <embed src=\"../pdf/$pdf.pdf\" type=\"application/pdf\" />
    </object>
</body>
</html>";